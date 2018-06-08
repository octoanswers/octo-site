<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class AnswersID_PUT_APIController extends Abstract_APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $this->lang = $args['lang'];
            $this->l = Localizer::getInstance($this->lang);

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

            $old_answer_text = $answer->getText();
            $opcodes = FineDiff::getDiffOpcodes($old_answer_text, $new_answer_text, FineDiff::$wordGranularity);

            # Update answer

            $answerUpdatedAt = (new DateTime('NOW'))->format('Y-m-d H:i:s');

            $answer->setID($answer_id);
            $answer->setText($new_answer_text);
            $answer->setUpdatedAt($answerUpdatedAt);

            $answer = (new Answer_Mapper($this->lang))->update($answer);

            # Create revision

            $revision = new Revision_Model();
            $revision->setAnswerID($answer_id);
            $revision->setOpcodes($opcodes);
            if ($old_answer_text) {
                $revision->setBaseText($old_answer_text);
            }
            $revision->setComment($revisionComment);
            $revision->setUserID($user->getID());

            Revision_Validator::validateComment($revisionComment);

            $parentRevision = (new Revisions_Query($this->lang))->lastRevisionForAnswerWithID($answer_id);
            if ($parentRevision) {
                $revision->setParentID($parentRevision->getID());
            }

            $revision = (new Revision_Mapper($this->lang))->save($revision);

            // Read updated question
            $question = (new Question_Query($this->lang))->questionWithID($answer_id);

            # Save activity

            $activity = new Activity_Model();
            $activity->setType(Activity_Model::F_U_UPDATE_A);
            $activity->setSubject($user);
            $activity->setData([ 'question' => $question, 'revision' => $revision]);
            $activity = (new UUpdateA_Activity_Mapper($this->lang))->create($activity);

            $activity = new Activity_Model();
            $activity->setType(Activity_Model::F_Q_UPDATE_A);
            $activity->setSubject($question);
            $activity->setData(['user' => $user, 'revision' => $revision]);
            $activity = (new QUpdateA_Activity_Mapper($this->lang))->create($activity);

            $output = [
                'question_id' => $answer_id,
                'question_title' => $question->getTitle(),
                'question_url' => $question->getURL($this->lang),
                'answer_text' => $new_answer_text,
                'revision_id' => $revision->getID(),
                'revision_opcodes' => $revision->getOpcodes(),
                'revision_base_text' => $revision->getBaseText(),
                'revision_comment' => $revision->getComment(),
                'user' => [
                    'id' => $user->getID(),
                    'name' => $user->getName(),
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
