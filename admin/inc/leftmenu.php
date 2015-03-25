
<div id="AccordionMenu">
    <h3><a href="#">สมาชิก | Member</a></h3>
    <div>
        <ul>
            <li><a href="<?php echo $_Config_live_site."/admin/member/index.php "?>">จัดการสมาชิก</a>
            </li>
        </ul>
    </div>

    <h3><a href="#">ร้านค้า | Store</a></h3>
    <div>
        <ul>
            <li><a href="<?php echo $_Config_live_site."/admin/store/index.php "?>">จัดการร้านค้า</a>
            </li>
        </ul>
    </div>

    <h3><a href="#">กิจกรรม | Campaign</a></h3>
    <div>
        <ul>
            <li><a href="<?php echo $_Config_live_site."/admin/campaign/index.php "?>">กฏการเล่นของใบเสร็จ</a>
            </li>
            <li><a href="<?php echo $_Config_live_site."/admin/campaign/index.php "?>">จัดการกิจกรรม</a>
            </li>
        </ul>
    </div>

    <h3><a href="#">รายงาน | Report</a></h3>
    <div>
        <ul>
            <li><a href="<?php echo $_Config_live_site."/admin/report/index.php "?>">จัดการรายงาน</a>
            </li>
        </ul>
    </div>

    <?php if($_SESSION[ '_GRPLEVEL']=="Administrator" ) { ?>
    <h3><a href="#">ผู้ดูแล | Admin</a></h3>
    <div>
        <ul>
            <li><a href="<?php echo $_Config_live_site."/admin/staff/index.php "?>">จัดการผู้ดูแลระบบ</a>
            </li>
        </ul>
    </div>
    <?php } ?>

</div>
