<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app['debug'] = true;

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function(Request $request) use ($app) {
        $movFilePath = __DIR__.'/../web/movies/sample_iTunes.mov';
        $folderPath = str_replace('.mov', '', $movFilePath);
        $images = [];
        if (file_exists($folderPath)) {
            $images = array_diff(scandir($folderPath), array('..', '.'));
        } else {
            mkdir($folderPath);
            `ffmpeg -i ${movFilePath} -vf fps=1/30 ${folderPath}/img%03d.png`;
            $images = array_diff(scandir($folderPath), array('..', '.'));
        }

        $baseUrl = $request->getSchemeAndHttpHost();

        return $app['twig']->render('home.html.twig', array('images' => $images, 'folderPath' => $folderPath, 'baseUrl' => $baseUrl));
    });

    return $app;
