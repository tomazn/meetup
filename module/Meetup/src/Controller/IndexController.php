<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Repository\MeetupRepository;
use Meetup\Form\MeetupForm;
use Zend\Form\Element\DateTime;
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

                $start = new \DateTime($form->getData()['start']);
                $end  = new \DateTime($form->getData()['end']);

                $meetup = $this->meetupRepository->createMeetup(
                    $form->getData()['title'],
                    $form->getData()['description'],
                    $start,
                    $end
                );

                $this->meetupRepository->add($meetup);
                return $this->redirect()->toRoute('meetup');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
        ]);
    }
}
