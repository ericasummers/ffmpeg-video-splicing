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
        $videoFileEndings = ['.mov', '.avi', '.gif', '.mp4', '.webm'];
        $folderPath = str_replace($videoFileEndings, '', $movFilePath);
        $images = [];
        if (file_exists($folderPath)) {
            $allFolderFileNames = array_diff(scandir($folderPath), array('..', '.'));
            foreach($allFolderFileNames as $fileName) {
                if (pathinfo($fileName)['extension'] === 'jpg' || pathinfo($fileName)['extension'] === 'png') {
                    array_push($images, $fileName);
                }
            }
        } else {
            mkdir($folderPath);
            exec('ffmpeg -i ' . $movFilePath . ' -vf fps=1/30 ' . $folderPath . '/img%03d.png');
            $allFolderFileNames = array_diff(scandir($folderPath), array('..', '.'));
            foreach($allFolderFileNames as $fileName) {
                if (pathinfo($fileName)['extension'] === 'jpg' || pathinfo($fileName)['extension'] === 'png') {
                    array_push($images, $fileName);
                }
            }
        }

        $baseUrl = $request->getSchemeAndHttpHost();

        return $app['twig']->render('home.html.twig', array('images' => $images, 'folderPath' => $folderPath, 'baseUrl' => $baseUrl));
    });

    return $app;
