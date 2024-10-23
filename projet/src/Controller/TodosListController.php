<?php

namespace App\Controller;

use App\Entity\TodosList;
use App\Form\TodosListType;
use App\Repository\TodosListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoListController extends AbstractController
{
    /**
     * @Route("/todolist/create", name="create_todolist", methods={"GET", "POST"})
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $todoList = new TodosList();
        $form = $this->createForm(TodosListType::class, $todoList);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($todoList);
            $em->flush();

            return $this->redirectToRoute('list_todolists');
        }

        return $this->render('todolist/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    public function index(TodosListRepository $todosListRepository): Response
    {
        $todoLists = $todosListRepository->findAll();

        return $this->render('todolist/index.html.twig', [
            'todoLists' => $todoLists,
        ]);
    }
}
