<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ratsoid
 * Date: 17.06.2014
 * Time: 20:06
 * To change this template use File | Settings | File Templates.
 */

$bg_style.='background-image: url('.$bg_src[0].'); ';
$bg_style.="background-position: ".$id['bgpos_h']." ".$id['bgpos_v']."; ";
$bg_style.="background-repeat: ".$id['bgpost_r']."; ";
$bg_style.="background-size: ".$id['bgpos_s']."; ";
$bg_style.="background-color: ".$id['background_color']."; ";
$bg_style.="color: ".$id['body_color']."; ";
$bg_style.="text-align: ".$id['body_align']."; ";
$p_style.="width: ".$id['section_width']."".$id['section_width_size']."; display: inline-block; ";
if($id['middlealign'] == 'yes') $bg_style.="display: table;";