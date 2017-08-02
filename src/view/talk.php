<?php $this->layout('template', ['title' => '/dev/night talks']) ?>


<?php foreach ($talks as $talk): ?>
    <?php $talk = collect($talk['node']);?>

    <div class="mdl-card mdl-cell mdl-shadow--3dp">
        <figure class="mdl-card__media mdl-color--primary">

        </figure>
        <br>
        <div class="mdl-card__title">
            <h3>
                <a href="<?= $this->e($talk->get('url')); ?>">
                    <?= $this->e($talk->get('title'));?>
                </a>
            </h3>
        </div>
        <div class="mdl-card__supporting-text">
            <?php $assignees = collect($talk->get('assignees'))->flatten(2); ?>
            <?php if(!$assignees->isEmpty()): ?>
                <b>Speaker: </b>
                <?php foreach ($assignees as $speaker): ?>
                    <?php //d($speaker) ?>
                    <a href="<?= $this->e($speaker['url']); ?>">
                        <img class="speaker_pic"
                             src="<?= $this->e($speaker['avatarUrl']) ?>"
                             title="<?= $this->e($speaker['name']) ?>"
                        >
                    </a>
                <?php endforeach ?>
            <?php endif ?>
        </div>

        <div class="mdl-layout-spacer"></div>

        <div class="mdl-card__actions mdl-card--border">
            <?php $reactions = collect($talk->get('reactions'))->flatten(); ?>
            <?php foreach ($reactions as $reaction): ?>
                <?php //d($reaction)?>
                <?php
                    $emoji = '';
                    switch ($reaction) {
                        case "THUMBS_UP":
                            $emoji = '1f44d';
                            break;
                        case "THUMBS_DOWN":
                            $emoji = '1f44e';
                            break;
                        case "LAUGH":
                            $emoji = '1f604';
                            break;
                        case "HOORAY":
                            $emoji = '1f389';
                            break;
                        case "CONFUSED":
                            $emoji = '1f615';
                            break;
                        case "HEART":
                            $emoji = '2665';
                            break;
                    }
                ?>
                <i class="twa twa-2x twa-<?= $this->e($emoji); ?>"></i>
            <?php endforeach ?>
        </div>
    </div>
<?php endforeach ?>
