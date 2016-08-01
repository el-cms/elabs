<?php

/*
 * CowsayPHP is based on the Tony Monroe's sowtfare Cowsay.
 * http://www.nog.net/~tony/warez/cowsay.shtml
 *
 * Edited in an other age by mtancoigne:
 * https://github.com/mtancoigne/cowsays-php
 */

namespace App\View\Helper;

use Cake\View\Helper;

/**
 * Elabs CowSaysHelper
 */
class CowSaysHelper extends Helper
{
    public $cows = [
        // Default cow
        'default' => '
        %1$s   ^__^
         %1$s  (%2$s)\\_______
            (__)\\       )\\/\\
             %3$s ||----w |
                ||     ||',
        //The Budweiser frogs
        'bud_frog' => '
        %1$s
         %1$s
           oO)-.                       .-(Oo
          /__  _\\                     /_  __\\
          \\  \\(  |     ()~()         |  )/  /
           \\__|\\ |    (-___-)        | /|__/
           \'  \'--\'    ==`-\'==        \'--\'  \'',
        // Bunny
        'bunny' => '
  %1$s
   %1$s   \\
        \\ /\\
        ( )
      .( o ).',
        // Elephant and snake
        'elephant_snake' => '
   %1$s
    %1$s              ....
           ........    .
          .            .
         .             .
.........              ........
...............................

  Elephant inside ASCII snake',
        // The flaming sheep, contributed by Geordan Rosario (geordan@csua.berkeley.edu)
        'flaming_sheep' => '
  %1$s            .    .     .
   %1$s      .  . .     `  ,
    %1$s    .; .  : .\' :  :  : .
     %1$s   i..`: i` i.i.,i  i .
      %1$s   `,--.|i |i|ii|ii|i:
           U%2$sU\\.\'@@@@@@`.||\'
           \\__/(@@@@@@@@@@)\'
                (@@@@@@@@)
                `YY~~~~YY\'
                 ||    ||',
        // Wonderful koala
        'koala' => '
  %1$s
   %1$s
       ___
     {~._.~}
      ( Y )
     ()~*~()
     (_)-(_)',
        // Luke skywalker koala
        'luke_koala' => '
  %1$s
   %1$s          .
       ___   //
     {~._.~}//
      ( Y )K/
     ()~*~()
     (_)-(_)
     Luke
     Sywalker
     koala',
        // A moose
        'moose' => '
  %1$s
   %1$s   \\_\\_    _/_/
    %1$s      \\__/
           (%2$s)\\_______
           (__)\\       )\\/\\
            %3$s ||----w |
               ||     ||',
        // Sheep
        'sheep' => '
  %1$s
   %1$s
       __
      U%2$sU\\.\'@@@@@@`.
      \\__/(@@@@@@@@@@)
           (@@@@@@@@)
           `YY~~~~YY\'
            ||    ||',
        // Scowleton
        'scowleton' => '
          %1$s      (__)
           %1$s     /%2$s|
            %1$s   (_\"_)*+++++++++*
                   //I#\\\\\\\\\\\\\\\\I\\
                   I[I|I|||||I I `
                   I`I\'///\'\' I I
                   I I       I I
                   ~ ~       ~ ~
                     Scowleton',
        // Darth vader koala
        'vader_koala' => '
   %1$s
    %1$s        .
     .---.  //
    Y|o o|Y//
   /_(i=i)K/
   ~()~*~()~
    (_)-(_)

     Darth
     Vader
     koala',
        // Cowth vader
        'cowth_vader' => '
        %1$s    ,-^-.
         %1$s   !oYo!
          %1$s /./=\\.\\______
               ##        )\\/\\
                ||-----w||
                ||      ||

               Cowth Vader'
    ];
    public $lines = [
        'think' => [
            'line' => 'o',
            'left' => '( ',
            'right' => ' )',
        ],
        'default' => [
            'line' => "\\",
            'left' => "| ",
            'right' => " |",
        ]
    ];
    public $eyes = [
        'borg' => ['==', '  '],
        'dead' => ['xx', 'U '],
        'greedy' => ['$$', '  '],
        'paranoid' => ['@@', '  '],
        'stoned' => ['**', '  '],
        'tired' => ['--', '  '],
        'wired' => ['00', '  '],
        'young' => ['..', '  '],
        'default' => ['oo', '  '],
    ];
    public $corners = [
        'default' => [
            'topLeft' => '/',
            'topRight' => '\\',
            'bottomLeft' => '\\',
            'bottomRight' => '/',
        ],
        'square' => [
            'topLeft' => '+',
            'topRight' => '+',
            'bottomLeft' => '+',
            'bottomRight' => '+',
        ],
    ];

    /**
     * Returns a <pre> element with a nice cow in it
     *
     * @param string $message the message to display
     * @param array $options An array of options to customize the cow
     *
     * @return string
     */
    public function say($message, $options = [])
    {
        $options += [
            'sign' => null, // Signature
            'cow' => 'default', // Type of cow
            'eyes' => 'default', // Eyes type
            'speakLines' => 'default', // Lines between balloon and cow
            'corners' => 'default', // Change the balloon corners
            'signClass' => null, // Signature class
            'msgClass' => null, // Message class
            'balloonClass' => null, // Ballon text class
            'cowClass' => null, // Whole cow text class
        ];

        // Cut the message at each linebreak
        $strings = explode("\n", $message);

        // Add the signature
        if (!empty($options['sign'])) {
            $strings[] = $this->_signature($options['sign'], $options['signClass']);
        }

        // Determine the longer string lenght
        $maxLen = 0;
        foreach ($strings as $currentLine) {
            $currLen = strlen(strip_tags($currentLine));
            if ($maxLen < $currLen) {
                $maxLen = $currLen;
            }
        }

        // Creating ballon content, with borders
        $balloon = '';
        $counter = 1;
        $nbStrings = count($strings);
        foreach ($strings as $currentLine) {
            // Determine if final line, for the signature
            $isFinalLine = ($counter == $nbStrings && !empty($options['sign']));
            // Line wich will be displayed in the balloon
            $lineFinal = $currentLine;
            // Spaces
            $spaceFiller = '';
            // Determine number of spaces to add
            $nbSpaces = $maxLen - (strlen(strip_tags($currentLine)));
            // Line class
            if (!empty($options['msgClass']) && (!$isFinalLine || ($isFinalLine && empty($options['signClass'])))) {
                $lineFinal = '<span class="' . $options['msgClass'] . '">' . $lineFinal . '</span>';
            }
            // Filling lines with spaces
            for ($i = 0; $i < $nbSpaces; $i++) {
                $spaceFiller .= ' ';
            }
            // Signature
            if ($isFinalLine) {
                $lineFinal = $spaceFiller . $lineFinal;
            } else {
                $lineFinal .= $spaceFiller;
            }
            // Line creation
            $balloon .= $this->lines[$options['speakLines']]['left'] . $lineFinal . $this->lines[$options['speakLines']]['right'] . "\n";
            $counter++;
        }

        // Create the top and bottom lines of the balloon
        $finalBalloon = $this->_createLine($maxLen, 'top', $options['corners']) . $balloon . $this->_createLine($maxLen, 'bottom', $options['corners']);

        if (!empty($options['balloonClass'])) {
            $finalBalloon = '<span class="' . $options['balloonClass'] . '">' . $finalBalloon . '</span>';
        }
        // Cow
        $finalCow = $finalBalloon . $this->cows[$options['cow']];
        if (!empty($options['cowClass'])) {
            $finalCow = '<span class="' . $options['cowClass'] . '">' . $finalCow . '</span>';
        }
        // Final string to return
        return sprintf('<pre class = "cow-box">' . $finalCow . '</pre>', $this->lines[$options['speakLines']]['line'], $this->eyes[$options['eyes']][0], $this->eyes[$options['eyes']][1]);
    }

    /**
     * Returns a random cow
     *
     * @param string $string Message to display
     *
     * @return string
     */
    public function sayError($string)
    {
        $eyes = array_rand($this->eyes);
        $lines = array_rand($this->lines);
        $corners = array_rand($this->corners);
        $cow = array_rand($this->cows);

        return $this->say($string, ['sign' => 'The server', 'cow' => $cow, 'eyes' => $eyes, 'speakLines' => $lines, 'corners' => $corners, 'signClass' => 'text-warning', 'msgClass' => 'text-danger']);
    }

    /**
     * Handles the signature creation
     *
     * @param string $string Signature
     * @param string $class Text class for the signature
     *
     * @return string
     */
    protected function _signature($string, $class = null)
    {
        $out = '~ ' . $string . ' ~ ';
        if (!empty($class)) {
            $out = '<span class="' . $class . '">' . $out . '</span>';
        }

        return $out;
    }

    /**
     * Returns a ballon top or bottom line
     *
     * @param int $length Balloon width, in chars.
     * @param string $pos Position: top or bottom
     * @param string $corners Type of corners
     *
     * @return string
     */
    protected function _createLine($length, $pos, $corners)
    {
        $out = '';
        $line = '';
        for ($i = 0; $i < $length + 2; $i++) {
            $out .= '-';
        }
        if ($pos === 'top') {
            $out = $this->corners[$corners]['topLeft'] . $out . $this->corners[$corners]['topRight'] . "\n";
        } else {
            $out = $this->corners[$corners]['bottomLeft'] . $out . $this->corners[$corners]['bottomRight'];
        }

        return $out;
    }
}
