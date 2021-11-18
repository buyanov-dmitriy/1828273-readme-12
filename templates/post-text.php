<p><?=cutText(htmlspecialchars($content));?></p>
<?php if(cutText(htmlspecialchars($content)) != htmlspecialchars($content)): ?>
    <a class="post-text__more-link" href="#">Читать далее</a>
<?php endif ?>
