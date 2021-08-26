<?php

namespace App\Service;

use App\Entity\Post;
use App\Repository\PostRepository;
use http\Env\Response;

/**
 * Class PostExporter
 *
 * @author Valeriy Malyshev
 */
class PostExporter
{
    /**
     * @param PostRepository $postRepository
     * @param integer        $postId
     * @return Post|null
     */
    public function readPostFromDb(PostRepository $postRepository, $postId): ?Post
    {
        return $postRepository->find($postId);
    }

    /**
     * @param PostRepository $postRepository
     * @param integer        $postId
     * @param string         $format
     * @return Response|void
     */
    public function writeInFile(PostRepository $postRepository, $postId, $format)
    {
        if ($format == ('txt' || 'html')) {
            $this->fileForceContents(
                __DIR__ . '/../../public/' . $format . '/TextDataFromPost#' . $postId . '__' . (new \DateTime())->format('Y/m/d-H_i_s') . '.' . $format,
                $this->readPostFromDb($postRepository, $postId)->getDescription()
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
        $dir = '';
        foreach ($parts as $part) {
            if (!is_dir($dir .= '/' . $part)) {
                mkdir($dir);
            }
        }
        file_put_contents('$dir/$file', $contents);
    }
}
