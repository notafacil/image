<?php
/**
 * Image Module
 *
 * @link
 * @copyright Copyright (c) 2018
 */

namespace NotafacilAPI\Image;

/**
 * Contém alguns eventos para a API de imagens
 *
 * @author Sergio Hermes <hermes.sergio@gmail.com>
 */
class Event
{
    /**
     * post upload
     */
    const POST_UPLOAD  = 'notafacil.image.post.upload';


    /**
     * post success
     */
    const POST_SUCCESS = 'notafacil.image.post.success';

    /**
     * post failed
     */
    const POST_FAILED  = 'notafacil.image.post.failed';

    /**
     * put success
     */
    const PUT_SUCCESS  = 'notafacil.image.put.success';

    /**
     * put failed
     */
    const PUT_FAILED   = 'notafacil.image.put.failed';

    /**
     * patch success
     */
    const PATCH_SUCCESS = 'notafacil.image.patch.success';

    /**
     * patch failed
     */
    const PATCH_FAILED  = 'notafacil.image.patch.failed';

    /**
     * del success
     */
    const DEL_SUCCESS  = 'notafacil.image.del.success';

    /**
     * del failed
     */
    const DEL_FAILED   = 'notafacil.image.del.failed';
}
