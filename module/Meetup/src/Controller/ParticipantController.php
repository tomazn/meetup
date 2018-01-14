<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Form\ParticipantForm;
use Meetup\Repository\ParticipantRepository;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\PhpEnvironment\Request;

final class ParticipantController extends AbstractActionController
{
    /**
     * @var ParticipantRepository
     */
    private $participantRepository;

    /**
     * @var ParticipantForm
     */
    private $participantForm;

    public function __construct(ParticipantRepository $participantRepository, ParticipantForm $participantForm)
    {
        $this->participantRepository = $participantRepository;
        $this->participantForm = $participantForm;
    }

    public function indexAction()
    {
        return new ViewModel([
            'participants' => $this->participantRepository->findAll(),
        ]);
    }


    public function addAction()
    {
        $form = $this->participantForm;

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {

                $name = $form->getData()['name'];
                $job = $form->getData()['job'];



                    $participant = $this->participantRepository->createParticipant(
                        $name,
                        $job
                    );


                    $this->participantRepository->add($participant);
                    return $this->redirect()->toRoute('participant');

            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
        ]);

    }

    public function editAction()
    {
        $form = $this->participantForm;

        $id = $this->params('id');

        $participant = $this->participantRepository->get($id);

        if(is_null($participant)){
            throw new \Exception("Ce participant n'exsite pas.");
        }

        $form = $this->participantForm;


        $data = [
            'name' => $participant->getName(),
            'job' => $participant->getJob()
        ];

        $form->setData($data);

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {

                $name = $form->getData()['name'];
                $job = $form->getData()['job'];



                $participant = $this->participantRepository->createParticipant(
                    $name,
                    $job
                );


                $this->participantRepository->add($participant);
                return $this->redirect()->toRoute('participant');

            }
        }

        $form->prepare();


        return new ViewModel([
            'form' => $form,
        ]);

    }

    public function getAction()
    {
        $id = $this->params('id');
        $participant = $this->participantRepository->get($id);

        if(is_null($participant)){
            throw new \Exception("Ce participant n'exsite pas.");
        }

        return new ViewModel([
            'participant' => $participant
        ]);
    }

    public function deleteAction()
    {
        $id = $this->params('id');
        $participant = $this->participantRepository->get($id);

        if(is_null($participant)){
            throw new \Exception("Ce participant n'exsite pas.");
        }

        $this->participantRepository->delete($participant);
        return $this->redirect()->toRoute('participant');
    }
}
