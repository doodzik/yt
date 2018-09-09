<?php
require(__DIR__ . '/../../init.php');

echo html(title('Homespot - About'),
          navigation($user->is_authed()) .
          navigation($user->is_authed()) .
          content(
            h1('About') .
            p('A skateboard tricks todo website') .
            p('Never forget the tricks you want to do') .
            p('Skateboarding isnt a sport') .
            p('No css and no js.') .
            a('check out the mothersite', 'http://321157.eu') .
            br() .
            a('check out my personal website', 'http://dudzik.co') .
            br() .
            a('check out the source code', 'https://github.com/doodzik/homespot')));
?>
