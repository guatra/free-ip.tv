<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use kartik\icons\Icon;
use yii\bootstrap\Carousel;
use yii\helpers\Url;


?>
<!-- Main -->
<div id="main">
    <div class="inner">

        <!-- Header -->
        <header id="header">
            <a href="#" class="logo"><strong>ПРивет</strong> юзер</a>
            <ul class="icons">
                <li>
                    <?= Html::a(Icon::show('vk', ['class' => 'icon'], Icon::FA), 'https://vk.com/freeiptv', ['class' => 'icon fa vk']) ?>
                </li>
            </ul>
        </header>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-xs-2 col-md-2">
                        <?=Html::img('@web/images/tv/one.jpg', [ 'class' => 'img-responsive']) ?>
                        <?=Html::img('@web/images/tv/ntv.jpg', [ 'class' => 'img-responsive']) ?>
                    </div>

                    <div class="col-xs-10 col-md-8">

                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">

                            <div class="video-js vjs-default-skin vjs-big-play-centered vjs-controls-enabled vjs-workinghover vjs-default-skin_desktop vjs-feedback vjs-countdown-start vjs-audiotracks vjs-has-started vjs-live-hidden-time vjs-live webcaster_player_e38209-dimensions vjs-paused vjs-user-inactive" style="width: 100%; height: 100%; outline: none;" id="webcaster_player_e38209" tabindex="-1" role="region" aria-label="video player"><video id="webcaster_player_e38209_html5_api" style="width: 100%; height: 100%;" class="vjs-tech" preload="auto" autoplay="" src="blob:https://otr.webcaster.pro/75d39f7c-997a-4b6f-b28e-347d1b7d03e1"></video><div class="vjs-black-poster vjs-hidden"></div><div></div><div class="vjs-poster vjs-hidden" tabindex="-1" style="background-image: url(&quot;//rec-2-2.webcaster.pro/fc/sdf1/thumbnails/events/38209/25458565.jpg&quot;);"></div><div class="vjs-text-track-display vjs-hidden" aria-live="assertive" aria-atomic="true"></div><div class="vjs-loading-spinner" dir="ltr"></div><button class="vjs-big-play-button vjs-hidden" type="button" aria-live="polite" title="Play Video"><span class="vjs-control-text">Play Video</span></button><div class="vjs-control-bar" dir="ltr" role="group"><div class="vjs-progress-control vjs-control"><div tabindex="0" class="vjs-progress-holder vjs-slider vjs-slider-horizontal" role="slider" aria-valuenow="0.00" aria-valuemin="0" aria-valuemax="100" aria-label="progress bar" aria-valuetext="0:02:27"><div class="vjs-load-progress" style="width: 0%;"><span class="vjs-control-text" style="left: 2.22815%; width: 97.7719%;"><span>Loaded</span>: 0%</span></div><div class="vjs-mouse-display" data-current-time="0:00" style="left: 0px;"></div><div class="vjs-play-progress vjs-slider-bar" data-current-time="0:02:27" style="width: 0%;"><span class="vjs-control-text"><span>Progress</span>: 0%</span></div></div></div><button class="vjs-play-control vjs-control vjs-button vjs-paused" type="button" aria-live="polite" title="Play"><span class="vjs-control-text">Play</span></button><div class="vjs-volume-menu-button vjs-menu-button vjs-menu-button-inline vjs-control vjs-button vjs-volume-menu-button-horizontal vjs-vol-3" tabindex="0" role="button" aria-live="polite" title="Mute"><div class="vjs-menu"><div class="vjs-menu-content"><div tabindex="0" class="vjs-volume-bar vjs-slider-bar vjs-slider vjs-slider-horizontal" role="slider" aria-valuenow="100.00" aria-valuemin="0" aria-valuemax="100" aria-label="volume level" aria-valuetext="100.00%"><div class="vjs-volume-level" style="width: 100%;"><span class="vjs-control-text"></span></div></div></div></div><span class="vjs-control-text">Mute</span></div><div class="vjs-current-time vjs-time-control vjs-control"><div class="vjs-current-time-display" aria-live="off"><span class="vjs-control-text">Current Time</span> 0:02:27</div></div><button class="vjs-live-control vjs-control vjs-button clickable"><div class="vjs-live-display" aria-live="off"><span class="vjs-control-text">Stream Type</span>LIVE</div></button><div class="vjs-custom-control-spacer vjs-spacer ">&nbsp;</div><div class="vjs-quality-switcher vjs-menu-button vjs-menu-button-popup vjs-control vjs-button" tabindex="0" role="menuitem" aria-live="polite" title="Quality" aria-expanded="false" aria-haspopup="true"><div class="vjs-menu" role="presentation"><ul class="vjs-menu-content" role="menu"><li class="vjs-menu-item vjs-selected" tabindex="-1" role="menuitemcheckbox" aria-live="polite" aria-checked="true" title="selected">auto<span class="vjs-control-text">selected</span></li><li class="vjs-menu-item" tabindex="-1" role="menuitemcheckbox" aria-live="polite" aria-checked="false" title=" ">720p<span class="vjs-control-text"> </span></li><li class="vjs-menu-item" tabindex="-1" role="menuitemcheckbox" aria-live="polite" aria-checked="false" title=" ">480p<span class="vjs-control-text"> </span></li><li class="vjs-menu-item" tabindex="-1" role="menuitemcheckbox" aria-live="polite" aria-checked="false" title=" ">360p<span class="vjs-control-text"> </span></li><li class="vjs-menu-item" tabindex="-1" role="menuitemcheckbox" aria-live="polite" aria-checked="false" title=" ">240p<span class="vjs-control-text"> </span></li></ul></div><span class="vjs-control-text">Quality</span><div class="vjs-quality-text">480p</div></div><div class="vjs-audiotracks-control vjs-control vjs-button vjs-hidden vjs-audiotracks-control_rus" tabindex="0" role="button" aria-live="polite" title="Audio Tracks"><span class="vjs-control-text">Audio Tracks</span></div><div class="vjs-feedback-control vjs-control vjs-button " tabindex="0" role="button" aria-live="polite" title="Report a problem"><span class="vjs-control-text">Report a problem</span></div><div class="vjs-audio-button vjs-menu-button vjs-menu-button-popup vjs-control vjs-button vjs-hidden" tabindex="0" role="menuitem" aria-live="polite" title="Audio Track" aria-expanded="false" aria-haspopup="true" aria-label="Audio Menu"><div class="vjs-menu" role="presentation"><ul class="vjs-menu-content" role="menu"></ul></div><span class="vjs-control-text">Audio Track</span></div><button class="vjs-fullscreen-control vjs-control vjs-button " type="button" aria-live="polite" title="Fullscreen"><span class="vjs-control-text">Fullscreen</span></button></div><div class="vjs-error-display vjs-modal-dialog vjs-hidden " tabindex="-1" aria-describedby="webcaster_player_e38209_component_323_description" aria-hidden="true" aria-label="Modal Window" role="dialog"><p class="vjs-modal-dialog-description vjs-offscreen" id="webcaster_player_e38209_component_323_description">This is a modal window.</p><div class="vjs-modal-dialog-content" role="document"></div></div><div class="vjs-caption-settings vjs-modal-overlay vjs-hidden" tabindex="-1" role="dialog" aria-labelledby="TTsettingsDialogLabel-webcaster_player_e38209_component_328" aria-describedby="TTsettingsDialogDescription-webcaster_player_e38209_component_328">
                                    <div role="document">
                                        <div role="heading" aria-level="1" id="TTsettingsDialogLabel-webcaster_player_e38209_component_328" class="vjs-control-text">Captions Settings Dialog</div>
                                        <div id="TTsettingsDialogDescription-webcaster_player_e38209_component_328" class="vjs-control-text">Beginning of dialog window. Escape will cancel and close the window.</div>
                                        <div class="vjs-tracksettings">
                                            <div class="vjs-tracksettings-colors">
                                                <fieldset class="vjs-fg-color vjs-tracksetting">
                                                    <legend>Text</legend>
                                                    <label class="vjs-label" for="captions-foreground-color-webcaster_player_e38209_component_328">Color</label>
                                                    <select id="captions-foreground-color-webcaster_player_e38209_component_328">
                                                        <option value="#FFF" selected="">White</option>
                                                        <option value="#000">Black</option>
                                                        <option value="#F00">Red</option>
                                                        <option value="#0F0">Green</option>
                                                        <option value="#00F">Blue</option>
                                                        <option value="#FF0">Yellow</option>
                                                        <option value="#F0F">Magenta</option>
                                                        <option value="#0FF">Cyan</option>
                                                    </select>
                                                    <span class="vjs-text-opacity vjs-opacity">
              <label class="vjs-label" for="captions-foreground-opacity-webcaster_player_e38209_component_328">Transparency</label>
              <select id="captions-foreground-opacity-webcaster_player_e38209_component_328">
                <option value="1" selected="">Opaque</option>
                <option value="0.5">Semi-Opaque</option>
              </select>
            </span>
                                                </fieldset>
                                                <fieldset class="vjs-bg-color vjs-tracksetting">
                                                    <legend>Background</legend>
                                                    <label class="vjs-label" for="captions-background-color-webcaster_player_e38209_component_328">Color</label>
                                                    <select id="captions-background-color-webcaster_player_e38209_component_328">
                                                        <option value="#000" selected="">Black</option>
                                                        <option value="#FFF">White</option>
                                                        <option value="#F00">Red</option>
                                                        <option value="#0F0">Green</option>
                                                        <option value="#00F">Blue</option>
                                                        <option value="#FF0">Yellow</option>
                                                        <option value="#F0F">Magenta</option>
                                                        <option value="#0FF">Cyan</option>
                                                    </select>
                                                    <span class="vjs-bg-opacity vjs-opacity">
              <label class="vjs-label" for="captions-background-opacity-webcaster_player_e38209_component_328">Transparency</label>
              <select id="captions-background-opacity-webcaster_player_e38209_component_328">
                <option value="1" selected="">Opaque</option>
                <option value="0.5">Semi-Transparent</option>
                <option value="0">Transparent</option>
              </select>
            </span>
                                                </fieldset>
                                                <fieldset class="window-color vjs-tracksetting">
                                                    <legend>Window</legend>
                                                    <label class="vjs-label" for="captions-window-color-webcaster_player_e38209_component_328">Color</label>
                                                    <select id="captions-window-color-webcaster_player_e38209_component_328">
                                                        <option value="#000" selected="">Black</option>
                                                        <option value="#FFF">White</option>
                                                        <option value="#F00">Red</option>
                                                        <option value="#0F0">Green</option>
                                                        <option value="#00F">Blue</option>
                                                        <option value="#FF0">Yellow</option>
                                                        <option value="#F0F">Magenta</option>
                                                        <option value="#0FF">Cyan</option>
                                                    </select>
                                                    <span class="vjs-window-opacity vjs-opacity">
              <label class="vjs-label" for="captions-window-opacity-webcaster_player_e38209_component_328">Transparency</label>
              <select id="captions-window-opacity-webcaster_player_e38209_component_328">
                <option value="0" selected="">Transparent</option>
                <option value="0.5">Semi-Transparent</option>
                <option value="1">Opaque</option>
              </select>
            </span>
                                                </fieldset>
                                            </div> <!-- vjs-tracksettings-colors -->
                                            <div class="vjs-tracksettings-font">
                                                <div class="vjs-font-percent vjs-tracksetting">
                                                    <label class="vjs-label" for="captions-font-size-webcaster_player_e38209_component_328">Font Size</label>
                                                    <select id="captions-font-size-webcaster_player_e38209_component_328">
                                                        <option value="0.50">50%</option>
                                                        <option value="0.75">75%</option>
                                                        <option value="1.00" selected="">100%</option>
                                                        <option value="1.25">125%</option>
                                                        <option value="1.50">150%</option>
                                                        <option value="1.75">175%</option>
                                                        <option value="2.00">200%</option>
                                                        <option value="3.00">300%</option>
                                                        <option value="4.00">400%</option>
                                                    </select>
                                                </div>
                                                <div class="vjs-edge-style vjs-tracksetting">
                                                    <label class="vjs-label" for="captions-edge-style-webcaster_player_e38209_component_328">Text Edge Style</label>
                                                    <select id="captions-edge-style-webcaster_player_e38209_component_328">
                                                        <option value="none" selected="">None</option>
                                                        <option value="raised">Raised</option>
                                                        <option value="depressed">Depressed</option>
                                                        <option value="uniform">Uniform</option>
                                                        <option value="dropshadow">Dropshadow</option>
                                                    </select>
                                                </div>
                                                <div class="vjs-font-family vjs-tracksetting">
                                                    <label class="vjs-label" for="captions-font-family-webcaster_player_e38209_component_328">Font Family</label>
                                                    <select id="captions-font-family-webcaster_player_e38209_component_328">
                                                        <option value="proportionalSansSerif" selected="">Proportional Sans-Serif</option>
                                                        <option value="monospaceSansSerif">Monospace Sans-Serif</option>
                                                        <option value="proportionalSerif">Proportional Serif</option>
                                                        <option value="monospaceSerif">Monospace Serif</option>
                                                        <option value="casual">Casual</option>
                                                        <option value="script">Script</option>
                                                        <option value="small-caps">Small Caps</option>
                                                    </select>
                                                </div>
                                            </div> <!-- vjs-tracksettings-font -->
                                            <div class="vjs-tracksettings-controls">
                                                <button class="vjs-default-button">Defaults</button>
                                                <button class="vjs-done-button">Done</button>
                                            </div>
                                        </div> <!-- vjs-tracksettings -->
                                    </div> <!--  role="document" -->
                                </div><div class="vjs-top-panel"><div class="vjs-tp-title">Прямая трансляция</div><div class="vjs-tp-description"></div><div class="vjs-duration vjs-time-control vjs-control"><div class="vjs-duration-display" aria-live="off"><span class="vjs-control-text">Duration Time</span> -:-:-</div></div></div><div class="vjs-feedback-form vjs-hidden" tabindex="-1" role="dialog"><div class="vjs-feedback-form-doc" role="document"><span class="vjs-feedback-form-close">×</span><div class="vjs-feedback-form-caption" role="heading">New feedback</div><div class="vjs-feedback-form-fields"><select id="vjs_feedback_subject" class="vjs-feedback-form-select"><option value="Select theme">Select theme</option><option value="Video problems">Video problems</option><option value="Sound problems">Sound problems</option><option value="Log in/sign up problems">Log in/sign up problems</option><option value="Other problems">Other problems</option></select><input id="vjs_feedback_contact_email" class="vjs-feedback-form-email" placeholder="E-mail" type="email"><textarea id="vjs_feedback_feed_text" class="vjs-feedback-form-textarea" placeholder="Message"></textarea><div class="vjs-feedback-form-subtext"></div><div id="vjs_feedback_resp" class="vjs-feedback-form-resp"></div><input class="vjs-feedback-form-send" type="button" value="Send"></div></div></div><div class="vjs-countdown-start-dialog vjs-modal-dialog vjs-hidden " tabindex="-1" aria-describedby="webcaster_player_e38209_component_396_description" aria-hidden="true" aria-label="Modal Window" role="dialog"><p class="vjs-modal-dialog-description vjs-offscreen" id="webcaster_player_e38209_component_396_description">This is a modal window.</p><div class="vjs-modal-dialog-content" role="document"></div></div><div class="vjs-audiotracks-settings vjs-modal-dialog vjs-hidden" tabindex="-1" aria-describedby="webcaster_player_e38209_component_411_description" aria-hidden="true" aria-label="Modal Window" role="dialog"><p class="vjs-modal-dialog-description vjs-offscreen" id="webcaster_player_e38209_component_411_description">This is a modal window.</p><div class="vjs-modal-dialog-content" role="document"><span class="vjs-audiotracks-settings-close">×</span><div class="vjs-audiotracks-settings-caption" role="heading">Audio Tracks</div><div class="vjs-audiotracks-settings-fields"><div class="vjs-audiotracks-settings-field"><input class="vjs-audiotracks-settings-field-radio" id="vjs_audiotracks_settings_field_defs" name="vjs_audiotracks_settings_type" type="radio" value="defs"><label class="vjs-audiotracks-settings-field-label" for="vjs_audiotracks_settings_field_defs">Main audio</label></div></div><input class="vjs-audiotracks-settings-accept" type="button" value="Accept"></div></div></div>


                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-md-12">
                        <p><h6>В телепрограмме указано московское время.</h6></p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <td class="hidden-xs">111</td>
                                    <td>112</td>
                                    <td>113</td>
                                </tr>
                                <tr>
                                    <th class="hidden-xs">121</th>
                                    <th>122</th>
                                    <th>123</th>
                                </tr>
                                <tr>
                                    <td class="hidden-xs">111</td>
                                    <td>112</td>
                                    <td>113</td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</div>

