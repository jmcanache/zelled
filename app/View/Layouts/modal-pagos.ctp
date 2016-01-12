<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */  
?>
<style type="text/css">
.label {
	display: block;
	margin-bottom: 6px;
	line-height: 19px;
    color: #666;
    font: 13px/1.55 "Open Sans",Helvetica,Arial,sans-serif;
    text-transform: inherit;
    letter-spacing: 0;
    text-align: left;
}

.ccjs-visa{
    background-attachment: scroll;
    background-clip: border-box;
    background-image: url("../img/visa.png");
    background-origin: padding-box;
    background-position: center top;
    background-repeat: no-repeat;
    background-size: auto auto;
    transition: all 0.5s ease 0s;	
}

.ccjs-mastercard{
    background-attachment: scroll;
    background-clip: border-box;
    background-image: url("../img/master.png");
    background-origin: padding-box;
    background-position: center top;
    background-repeat: no-repeat;
    background-size: auto auto;
    transition: all 0.5s ease 0s;	
}
.header-modal{
    height: 75px;
    left: 50%;
    margin-left: -38px;
    position: absolute;
    top: -30px;
    width: 76px;
}
.title{
    color: #000;
    font-size: 17px;
    font-weight: bold;
    height: 22px;
    text-align:center;
    position: relative;
    top: 25px;
}

.subtitle{
    font-size: 13px;
    font-weight: normal;
    text-align:center;
    position: relative;
    top: 20px;
}

header{
    background: rgba(248, 248, 248, 0.9) none repeat scroll 0 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    color: #232323;
    display: block;
    font-size: 25px;
    font-weight: 300;
    padding: 20px 30px;
    } 

</style>
<?php
echo $this->Html->css('bootstrap-theme.min');
echo $this->Html->css('creditcardjs-v0.10.12.min');
echo $this->fetch('content'); 
echo $this->Html->script('creditcardjs-v0.10.12.min.js');
?>