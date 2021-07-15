<p><?=cut_text($content);?></p>
<?php if(cut_text($content) != $content): ?>
    <a class="post-text__more-link" href="#">Читать далее</a>
<?php endif ?>
