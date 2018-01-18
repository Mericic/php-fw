<?php foreach ($_conferences as $conference): ?>
<section class="conference">
    <header>
        <h1 class="app-post-title"><?= $conference->getDetails()->getName() ?></h1>
        <h2 class="app-post-meta"><?= $conference->getDetails()->getDescription() ?></h2>
        <ul>
            <?php foreach ($conference->getDetails()->getGoals() as $goal): ?>
                <li><?= $goal ?></li>
            <?php endforeach ?>
        </ul>
        <p>Le <time><?= $conference->getDate() ?></time>
            de <?= $conference->getTimeSlot()->getStart() ?>
            à <?= $conference->getTimeSlot()->getEnd() ?>
            <span class="max-attendees">(<?= $conference->getMaxAttendees() ?> places disponibles)</span>
        </p>
    </header>
</section>
<?php endforeach ?>
