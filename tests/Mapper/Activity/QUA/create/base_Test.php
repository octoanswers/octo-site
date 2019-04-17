<?php

class Mapper_Activity_QUA__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['activities']];

    public function test_CreateWithFullParams_Ok()
    {
        $question = Question_Model::initWithTitle('Когда закончится дождь?');

        $answer = new Answer_Model();
        $answer->text = 'Melody of my life.';

        $user = new User_Model();
        $user->setID(13);
        $user->setName('Boris Bro');
        $user->setEmail('steve@aw.org');

        $revision = Revision_Model::initWithDBState([
            'rev_id' => 13,
            'rev_answer_id' => 11,
            'rev_opcodes' => 'opCodes',
            'rev_base_text' => 'Ответ на вопрос про птиц.',
            'rev_comment' => 'Rev comment',
            'rev_parent_id' => 2,
            'rev_user_id' => 14,
            'rev_created_at' => '2015-12-16 13:28:56',
        ]);

        $activity = new Activity_Model();
        $activity->type = Activity_Model::F_Q_UPDATE_A;
        $activity->subject = $question;
        $activity->data = ['user' => $user, 'revision' => $revision];

        $activity = (new QUpdateA_Activity_Mapper('ru'))->create($activity);

        $this->assertEquals(13, $activity->getID());
        $this->assertEquals(Activity_Model::F_Q_UPDATE_A, $activity->type);
    }
}
