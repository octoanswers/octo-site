<?php

namespace APIController\PUT;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class QuestionsIDAnswer extends \APIController\APIController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        try {
            $lang      = $request->getAttribute('lang');
            $answer_id = (int) $request->getAttribute('id');

            $post_params      = $request->getParsedBody();
            $new_answer_text  = (string) $post_params['answer_text']; //
            $revision_comment = (string) @$post_params['changes_comment'];

            $user_api_key = (string) $post_params['user_api_key'];

            $revision_comment = strlen($revision_comment)
                ? $revision_comment
                : null;

            // Check user
            $user = (new \Query\User)->userWithAPIKey($user_api_key);

            // Check answer
            $answer = (new \Query\Answers($lang))->answerWithID($answer_id);

            $old_answer_text = $answer->text;

            $granularity = new \cogpowered\FineDiff\Granularity\Word;
            $fineDiff    = new \cogpowered\FineDiff\Diff($granularity);

            $opcodes = (string) $fineDiff->getOpcodes($old_answer_text, $new_answer_text);

            // Update answer

            $answerUpdatedAt = (new \DateTime('NOW'))->format('Y-m-d H:i:s');

            $answer->id        = $answer_id;
            $answer->text      = $new_answer_text;
            $answer->updatedAt = $answerUpdatedAt;

            $answer = (new \Mapper\Answer($lang))->update($answer);

            // Create revision

            $revision           = new \Model\Revision;
            $revision->answerID = $answer_id;
            $revision->opcodes  = $opcodes;
            if ($old_answer_text) {
                $revision->baseText = $old_answer_text;
            }
            $revision->comment = $revision_comment;
            $revision->userID  = $user->id;

            \Validator\Revision::validateComment($revision_comment);

            $parentRevision = (new \Query\Revisions($lang))->lastRevisionForAnswerWithID($answer_id);
            if ($parentRevision) {
                $revision->parentID = $parentRevision->id;
            }

            $revision = (new \Mapper\Revision($lang))->save($revision);

            // Read updated question
            $question = (new \Query\Question($lang))->questionWithID($answer_id);

            // Save activity

            $activity          = new \Model\Activity;
            $activity->type    = \Model\Activity::F_U_UPDATE_A;
            $activity->subject = $user;
            $activity->data    = ['question' => $question, 'revision' => $revision];
            $activity          = (new \Mapper\Activity\UUpdateA($lang))->create($activity);

            $activity          = new \Model\Activity;
            $activity->type    = \Model\Activity::F_Q_UPDATE_A;
            $activity->subject = $question;
            $activity->data    = ['user' => $user, 'revision' => $revision];
            $activity          = (new \Mapper\Activity\QUpdateA($lang))->create($activity);

            $output = [
                'question_id'        => $answer_id,
                'question_title'     => $question->title,
                'question_url'       => $question->getURL($lang),
                'answer_text'        => $new_answer_text,
                'revision_id'        => $revision->id,
                'revision_opcodes'   => $revision->opcodes,
                'revision_base_text' => $revision->baseText,
                'revision_comment'   => $revision->comment,
                'user'               => [
                    'id'   => $user->id,
                    'name' => $user->name,
                ],
            ];
        } catch (\Throwable $e) {
            $output = [
                'error_code'    => $e->getCode(),
                'error_message' => $e->getMessage(),
            ];
        }

        $json = json_encode($output, JSON_UNESCAPED_UNICODE);

        return $response->withHeader('Content-Type', 'application/json')->write($json);
    }
}
