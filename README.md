# _FFMPEG video splicer test_

## Description

_This small test page uses FFMPEG to take a video file path and create frame images and insert into a folder in that directory. Test video in repo as well as individual code to be used in separate project._

_FFMPEG resources: [Link](https://en.wikibooks.org/wiki/FFMPEG_An_Intermediate_Guide/image_sequence), [Link2](https://trac.ffmpeg.org/wiki/Create%20a%20thumbnail%20image%20every%20X%20seconds%20of%20the%20video)_

## Setup/Installation Requirements

* Ensure [composer](https://getcomposer.org/) is installed on your computer.

* In terminal run the following commands:

1. _Fork and clone this repository from_ [gitHub]https://github.com/ericaw21/cutting-edge.git.
2. Navigate to the root directory of the project in which ever CLI shell you are using and run the command: `composer install`.
3. To run tests enter `composer test` in terminal.
4. Create a local server in the /web directory within the project folder using the command: php -S localhost:8000 (assuming you are using a mac), or php -S localhost:8888 (if using windows).
5. Open the directory http://localhost:8000/ (if on a mac) or http://localhost:8888/ (if on windows pc) in any standard web browser.
6. Start server with MAMP and make sure your mySQL server is set to 3306.

## Technologies Used

* _Composer_
* _CSS_
* _HTML_
* _PHP_
* _Silex_
* _Twig_

Copyright (c) 2017 **Erica Wright** All Rights Reserved.