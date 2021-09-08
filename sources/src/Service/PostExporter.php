<?php

namespace App\Service;

use App\Entity\Post;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PostExporter
 *
 * @author Valeriy Malyshev
 */
class PostExporter
{
    /**
     * @param Post   $post
     * @param string $format
     *
     * @return Response|void
     */
    public function writeInFile(Post $post, $format)
    {
        if ($format == 'txt' || $format == 'html') {
            $this->fileForceContents(
                __DIR__ . '/../../public/' . $format . '/TextDataFromPost#' . $post->getId() . '__' . (new \DateTime())->format('Y/m/d-H_i_s') . '.' . $format,
                $post->getDescription()
            );
        } else {
            return new Response('Invalid file extension');
        }
    }

    /**
     * @param string       $dir
     * @param string|array $contents
     *
     * @return void
     */
    public function fileForceContents($dir, $contents)
    {
        $parts = explode('/', $dir);
        $file = array_pop($parts);
        mkdir($dir, 0777, true);
        file_put_contents(sprintf('%s/%s', $dir, $file), $contents);
    }
}
