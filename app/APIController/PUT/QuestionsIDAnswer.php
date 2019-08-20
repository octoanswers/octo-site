<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class QuestionsIDAnswer_PUT_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];

            $answer_id = (int) $args['id'];
            $new_answer_text = (string) $request->getParam('answer_text');

            $revisionComment = (string) $request->getParam('changes_comment');
            $revisionComment = strlen($revisionComment) ? $revisionComment : null;

            $user_api_key = (string) $request->getParam('user_api_key');

            # Check user

            $user = (new User_Query())->userWithAPIKey($user_api_key);
            // @TODO Check rigths to edit

            # Check answer

            $answer = (new Answers_Query($this->lang))->answerWithID($answer_id);

            $old_answer_text = $answer->text;
            $opcodes = FineDiff::getDiffOpcodes($old_answer_text, $new_answer_text, FineDiff::$wordGranularity);

            # Update answer

            $answerUpdatedAt = (new DateTime('NOW'))->format('Y-m-d H:i:s');

            $answer->id = $answer_id;
            $answer->text = $new_answer_text;
            $answer->updatedAt = $answerUpdatedAt;

            $answer = (new Answer_Mapper($this->lang))->update($answer);

            # Create revision

            $revision = new Revision_Model();
            $revision->answerID = $answer_id;
            $revision->opcodes = $opcodes;
            if ($old_answer_text) {
                $revision->baseText = $old_answer_text;
            }
            $revision->comment = $revisionComment;
            $revision->userID = $user->id;

            Revision_Validator::validateComment($revisionComment);

            $parentRevision = (new Revisions_Query($this->lang))->lastRevisionForAnswerWithID($answer_id);
            if ($parentRevision) {
                $revision->parentID = $parentRevision->id;
            }

            $revision = (new Revision_Mapper($this->lang))->save($revision);

            // Read updated question
            $question = (new Question_Query($this->lang))->questionWithID($answer_id);

            # Save activity

            $activity = new Activity_Model();
            $activity->type = Activity_Model::F_U_UPDATE_A;
            $activity->subject = $user;
            $activity->data = ['question' => $question, 'revision' => $revision];
            $activity = (new UUpdateA_Activity_Mapper($this->lang))->create($activity);

            $activity = new Activity_Model();
            $activity->type = Activity_Model::F_Q_UPDATE_A;
            $activity->subject = $question;
            $activity->data = ['user' => $user, 'revision' => $revision];
            $activity = (new QUpdateA_Activity_Mapper($this->lang))->create($activity);

            $output = [
                'question_id' => $answer_id,
                'question_title' => $question->title,
                'question_url' => $question->get_URL($this->lang),
                'answer_text' => $new_answer_text,
                'revision_id' => $revision->id,
                'revision_opcodes' => $revision->opcodes,
                'revision_base_text' => $revision->baseText,
                'revision_comment' => $revision->comment,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                ]
            ];
        } catch (Throwable $e) {
            $output = [
                'error_code' => $e->getCode(),
                'error_message' => $e->getMessage(),
            ];
        }

        $json = json_encode($output, JSON_UNESCAPED_UNICODE);

        return $response->withHeader('Content-Type', 'application/json')->write($json);
    }
}
