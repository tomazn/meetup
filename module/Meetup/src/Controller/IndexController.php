<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Repository\MeetupRepository;
use Meetup\Form\MeetupForm;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class IndexController extends AbstractActionController
{
    /**
     * @var MeetupRepository
     */
    private $meetupRepository;

    /**
     * @var MeetupForm
     */
    private $meetupForm;

    public function __construct(MeetupRepository $meetupRepository, MeetupForm $meetupForm)
    {
        $this->meetupRepository = $meetupRepository;
        $this->meetupForm = $meetupForm;
    }

    public function indexAction()
    {
        return new ViewModel([
            'meetups' => $this->meetupRepository->findAll(),
        ]);
    }

    public function addAction()
    {
        $form = $this->meetupForm;

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $title = $form->getData()['title'];
                $description = $form->getData()['description'];
                $start = new \DateTime($form->getData()['start']);
                $end  = new \DateTime($form->getData()['end']);

                if($end > $start){
                    $meetup = $this->meetupRepository->createMeetup(
                        $title,
                        $description,
                        $start,
                        $end
                    );

                    $this->meetupRepository->add($meetup);
                    return $this->redirect()->toRoute('meetup');
                }else{

                }


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
            $meetup = $this->meetupRepository->get($id);

            return new ViewModel([
               'meetup' => $meetup
            ]);
    }

    public function editAction()
    {
        $request = $this->getRequest();

        $id = $this->params('id');

        $meetup = $this->meetupRepository->get($id);

        $form = $this->meetupForm;

        $data = [
            'title' => $meetup->getTitle(),
            'description' => $meetup->getDescription(),
            'start' => $meetup->getStart(),
            'end' => $meetup->getEnd()
        ];

        $form->setData($data);

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $title = $form->getData()['title'];
                $description = $form->getData()['description'];
                $start = new \DateTime($form->getData()['start']);
                $end  = new \DateTime($form->getData()['end']);

                if($end > $start){
                    $meetup->setTitle($title);
                    $meetup->setDescription($description);
                    $meetup->setStart($start);
                    $meetup->setEnd($end);

                    $this->meetupRepository->edit($meetup);
                    return $this->redirect()->toRoute('meetup');
                }else{

                }


            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function deleteAction()
    {
        $id = $this->params('id');
        $meetup = $this->meetupRepository->get($id);
        $this->meetupRepository->delete($meetup);

    }
}
