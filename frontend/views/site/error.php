<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

//$this->title = $name;
?>


<div id="main">
    <div class="inner">

        <!-- Header -->
        <header id="header">
            <a href="index.html" class="logo"><strong>Editorial</strong> by HTML5 UP</a>
            <ul class="icons">
                <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="icon fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
                <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="#" class="icon fa-medium"><span class="label">Medium</span></a></li>
            </ul>
        </header>

        <!-- Content -->
        <section>
            <header class="main">
                <h1><?= Html::encode($this->title) ?></h1>
            </header>


            <div class="major">
                <?//= nl2br(Html::encode($message)) ?>
            </div>

            <p>
                The above error occurred while the Web server was processing your request.
            </p>
            <p>
                Please contact us if you think this is a server error. Thank you.
            </p>

        </section>

    </div>
</div>