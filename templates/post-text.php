<p><?=cut_text(htmlspecialchars($content));?></p>
<?php if(cut_text(htmlspecialchars($content)) != htmlspecialchars($content)): ?>
    <a class="post-text__more-link" href="#">Читать далее</a>
<?php endif ?>
