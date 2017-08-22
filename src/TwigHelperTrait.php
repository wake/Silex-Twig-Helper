<?php

  /*
   * This TwigTrait is base on Silex/Application/TwigTrait.php by Fabien Potencier and add some helpful functions.
   *
   * Original author: Fabien Potencier <fabien@symfony.com>
   * Extended author: Wake Liu <wake.gs@gmail.com>
   *
   * For the full copyright and license information, please view the LICENSE
   * file that was distributed with this source code.
   */

  namespace Silex\Application;

  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\StreamedResponse;


  /**
   * Twig trait.
   *
   * @author Fabien Potencier <fabien@symfony.com>
   */
  trait TwigHelperTrait {


    /**
     * Assign varibles
     *
     * @param string $name  The parameter name to pass to the view
     * @param mixed  $value The parameter value to pass to the view
     *
     * @return Application A Silex application instance
     *
     */
    public function assign ($name, $value) {

      if (! isset ($this['twig.paras']))
        $this['twig.paras'] = [];

      $paras = $this['twig.paras'];

      if (isset ($paras[$name]))
        $paras[$name] = is_array ($paras[$name]) ? ($paras[$name] + (array) $value) : $value;

      else
        $paras += array ($name => $value);

      $this['twig.paras'] = $paras;

      return $this;
    }


    /**
     * Renders a view and returns a Response.
     *
     * To stream a view, pass an instance of StreamedResponse as a third argument.
     *
     * @param string   $view       The view name
     * @param array    $parameters An array of parameters to pass to the view
     * @param Response $response   A Response instance
     *
     * @return Response A Response instance
     */
    public function render ($view, array $parameters = array (), Response $response = null) {

      if (empty ($parameters) && isset ($this['twig.paras']))
        $parameters = $this['twig.paras'];

      if (null === $response)
        $response = new Response ();

      $twig = $this['twig'];

      if ($response instanceof StreamedResponse) {

        $response->setCallback (function () use ($twig, $view, $parameters) {
          $twig->display ($view, $parameters);
        });
      }

      else
        $response->setContent ($twig->render ($view, $parameters));

      return $response;
    }


    /**
     * Renders a view.
     *
     * @param string $view       The view name
     * @param array  $parameters An array of parameters to pass to the view
     *
     * @return Response A Response instance
     */
    public function renderView ($view, array $parameters = array ()) {

      return $this['twig']->render ($view, $parameters);
    }
  }
