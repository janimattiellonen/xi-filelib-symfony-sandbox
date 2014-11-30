<?php

namespace Filelib\Bundle\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Xi\Filelib\Renderer\SymfonyRenderer;
use Symfony\Component\HttpFoundation\Response;
use Xi\Filelib\File\DefaultFileOperator;
use Xi\Filelib\Command;
use Xi\Filelib\FileLibrary;

class DefaultController extends Controller
{
	public function clearAction()
    {
        $filelib = $this->getFilelib();

        foreach ($filelib->getFileOperator()->findAll() as $file) {
            $filelib->getFileOperator()->delete($file);
        }

        return new Response('All is clear!');
    }


    public function indexAction()
    {
        $filelib = $this->getFilelib();

        // We want to upload curious manatee image.
        $path = $this->get('kernel')->getRootDir() . "/data/uploads/west_indian_manatee_and_nursing_calf_crystal_river_florida.jpg";

		$file = $filelib->uploadFile($path);
		$publisher = $this->get('xi_filelib.publisher');

		$publisher->publishAllVersions($file);

        return $this->render('FilelibDemoBundle:Default:index.html.twig', array(
            'file' => $file,
        ));
    }

    /**
     * @return FileLibrary
     */
    protected function getFilelib()
    {
        return $this->get('xi_filelib');
    }
}
