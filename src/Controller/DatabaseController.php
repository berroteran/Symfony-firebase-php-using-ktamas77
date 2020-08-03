<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

// https://firestore.googleapis.com/v1/projects/YOUR_PROJECT_ID/databases/(default)/documents/cities/LA

const DEFAULT_URL = 'https://declaraciones-8daea.firebaseio.com/';
const DEFAULT_TOKEN = 'AuAef058GH30QllZHWK60QUwQ0AsHG10IUV4FwWF';
const DEFAULT_PATH = '/empresa';

class DatabaseController extends AbstractController
{
    /** @var Database */
    private $database;

    public function __construct()
    {

    }

    /**
     * @Route("/database", name="database")
     */
    public function index(): JsonResponse
    {

        $firebase = new \Firebase\FirebaseLib( DEFAULT_URL, DEFAULT_TOKEN);

// --- storing an array ---
        $test = [
            'foo' => 'bar',
            'i_love' => 'lamp',
            'id' => 42
        ];
        $dateTime = new \DateTime();
        $firebase->set(DEFAULT_PATH . '/' . $dateTime->format('c'), $test);

// --- storing a string ---
        $firebase->set(DEFAULT_PATH . '/name/contact001', 'John Doe');

// --- reading the stored string ---
        $name = $firebase->get(DEFAULT_PATH . '/name/contact001');


        $reference = '/declaraciones';
        //$snapshot = $this->database->getReference($reference)->getSnapshot();

        return $this->json([
            'reference' => $reference,
            //'num_children' => $snapshot->numChildren(),
            //'children' => $snapshot->hasChildren() ? array_keys($snapshot->getValue()) : null,
        ]);
    }
}
