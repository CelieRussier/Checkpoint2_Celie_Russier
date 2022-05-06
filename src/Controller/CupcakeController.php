<?php

namespace App\Controller;

use App\Service\Container;
use App\Model\CupCakeManager;
use App\Model\AccessoryManager;

/**
 * Class CupcakeController
 *
 */
class CupcakeController extends AbstractController
{
    /**
     * Display cupcake creation page
     * Route /cupcake/add
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->listAllAccessories();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //TODO Add your code here to create a new cupcake
            $cupCake = array_map('trim', $_POST);
            $cupCakeManager = new CupCakeManager();
            $cupCakeManager->insert($cupCake);
            header('Location:/cupcake/list');
        }
        //TODO retrieve all accessories for the select options
        return $this->twig->render('Cupcake/add.html.twig', ['accessories' => $accessories]);
    }

    /**
     * Display list of cupcakes
     * Route /cupcake/list
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list()
    {
        //TODO Retrieve all cupcakes
        $cupCakeManager = new CupCakeManager();
        $cupcakes = $cupCakeManager->listAllCupcakes();

        return $this->twig->render('Cupcake/list.html.twig', ['cupcakes' => $cupcakes]);
    }

    public function show(int $id)
    {
        $cupCakeManager = new CupCakeManager();
        $cupcake = $cupCakeManager->selectOneById($id);
        $accessoryManager = new AccessoryManager();
        $accessory = $accessoryManager->selectOneById($cupcake['accessory_id']);
        return $this->twig->render('cupcake/show.html.twig', ['cupcake' => $cupcake, 'accessory' => $accessory]);
    }
}
