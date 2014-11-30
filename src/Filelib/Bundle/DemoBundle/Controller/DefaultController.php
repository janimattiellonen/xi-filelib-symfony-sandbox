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

        foreach ($filelib->getFileRepository()->findAll() as $file) {
            $filelib->getFileRepository()->delete($file);
			$filelib->getResourceRepository()->delete($file->getResource());
        }

        return new Response('All is clear!');
    }

    public function uploadAction()
    {
         // We want to upload curious manatee image.
        $path = $this->get('kernel')->getRootDir() . "/data/uploads/west_indian_manatee_and_nursing_calf_crystal_river_florida.jpg";

		$file = $this->getFilelib()->uploadFile($path);
		$publisher = $this->get('xi_filelib.publisher');

		$publisher->publishAllVersions($file);

        return $this->render('FilelibDemoBundle:Default:index.html.twig', array(
            'file' => $file,
        ));
    }

	public function indexAction()
	{
		$files = $this->getFilelib()->getFileRepository()->findAll();

		// quick n' dirty hack to "redirect" to upload action if the images has not yet been generated
		if (count($files) === 0) {
			return $this->uploadAction();
		}

		$arr = $files->toArray();

		return $this->render('FilelibDemoBundle:Default:index.html.twig', array(
			'file' => $arr[0], // it has only 1 item
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
