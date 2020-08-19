<?php
    include('../_serv/zconect.php');
	date_default_timezone_set('America/Mexico_City');
        if(isset($_GET['ordid'])){
            $order_id = $_GET['ordid'];
        } else {
            $order_id = $argv[1];
        }
        $sql = "SELECT r.ord_id, r.ord_date,r.ord_reqdate,r.ord_orderclient,r.ord_amount AS ord_subtotal,r.ord_shipping,r.ord_total,sm.shdesc,zc.zipcode,zc.state,
                          d.ord_det,p.part_code,p.part_name,p.part_desc,d.ord_uprice,d.ord_qty,d.ord_disc,e.eta,d.ord_eta,d.ord_adj,d.ord_amount,c.cust_name,
                          c.cust_company,c.cust_billaddress,c.cust_billaddr2,c.cust_city,c.cust_state,c.cust_zip,r.ord_contact,r.ord_company,r.ord_shaddress,
                          r.ord_shaddr2,r.ord_shcity,r.ord_shstate,r.ord_shzip, a.ordaw_image_small_jpg AS smallaw, r.ord_ctrlcode,
                          (CASE 
                             WHEN  LENGTH(TRIM(COALESCE(a.ordaw_file_path,''))) > 0 THEN a.ordaw_file_path
                             WHEN  LENGTH(TRIM(COALESCE(a.ordaw_image_ai_to_jpg,''))) > 0 THEN a.ordaw_image_ai_to_jpg 
                             ELSE '' 
                          END) AS artimage                          
                     FROM orders AS r
                    INNER JOIN ord_details AS d ON r.ord_id = d.ord_id
                     LEFT JOIN ord_artwork AS a ON d.ord_id = a.ord_id AND d.ord_det = a.ord_det AND a.ordaw_status = 1
                    INNER JOIN customers AS c ON r.ord_custid = c.cust_id
                    INNER JOIN partnumber AS p ON d.ord_partid = p.part_id
                    INNER JOIN eta AS e ON d.ord_etaid = e.eta_id
                     LEFT JOIN shipmeth AS sm ON r.ord_shmt = sm.shid
                     LEFT JOIN zipcodes AS zc ON r.ord_zip = zc.zipcode
                    WHERE r.ord_id = $order_id";

$order = $db->ObjectBuilder()->rawQuery($sql);

$ordcli = $order[0]->ord_orderclient;

function String2PDFString($string,$Length)
{
    $NewString = '';
    $Arry=explode(" ",$string);
    foreach($Arry as $Line)
    {
        if(strlen($Line)>$Length)
            $NewString.=wordwrap ($Line,$Length," ",true);
        else
            $NewString.=" ".$Line;
    }
    return $NewString;
}
?>


<page backtop="150mm" backbottom="0mm" backleft="20mm" backright="20mm">
    <style>
        table th td{
            vertical-align: center;
        }

        .header{
            vertical-align:top;
            text-align: center;
            background-image: url(../images/mails/quoted_header.jpg);
            height: 670px;
            width: 800px;
        }

        .fecha{
            color: #d66937;
            font-weight: bold;
            font-size: 24px;
            position: absolute;
            top: 420px;
            width: 320px;
            height: 60px;
            left: 373px;
            padding-top: 25px;
        }

        .title{
            color: #d66937;
            text-align: center;
            font-size: 16px;
            width: 80px;
        }


        .sep-column{
            padding: 10px 10px 3px 0px;
            border-right: 1px solid #d5d6d6;
        }

        .art-link a{
            text-decoration: none;
            color: #4e4f50;
        }

        .description{
            width: 70px;
            text-align: center;
            color: #4e4f50;
        }

        .file-name{
            width: 50px;
            text-align: center;
            color: #4e4f50;
        }

        .part{
            width: 40px;
            text-align: center;
            color: #4e4f50;
        }

        .qty{
            width: 20px;
            text-align: center;
            color: #4e4f50;
        }

        .price{
            width: 60px;
            text-align: right;
        }

        .disc{
            width: 30px;
            text-align: center;
            color: #4e4f50;
        }

        .title-amount{
            margin-right: 120px;
            padding-right: 10px;
        }

        .details-date{
            color: #d66937;
            position: absolute;
            bottom: 152px;
            left: 170px;
            font-size: 10px;
        }

        .details-to{
            color: #b3b1ad;
            position: absolute;
            bottom: 130px;
            left: 285px;
            font-size: 10px;
            text-align: left;
        }

        .details-amount{
            color: #5e5f5f;
            position: absolute;
            bottom: 125px;
            left: 585px;
            font-size: 14px;
        }

        .details-number{
            color: #d66937;
            position: absolute;
            bottom: 90px;
            left: 170px;
        }

        .details-shipp{
            color: #d66937;
            position: absolute;
            bottom: 85px;
            left: 285px;
        }
    </style>
    <page_header>
        <table style="width: 100%;">
            <tr>
                <td class="header" style="text-align: center; width: 800px; height: 560px;">
                    <div class="fecha">
                        <?php echo date("F d, Y", strtotime($order[0]->ord_reqdate)) ?>
                    </div>
                </td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <div style="position: relative; width: 800px; height: 273px;">
        <table style="width: 100%;">
            <tr>

                <td style="text-align: center; width: 800px; height: 273px;">
                    <img src="../images/mails/approval_footer_client.jpg" alt="">
                    <div class="details-date"><?php echo date("F d, Y", strtotime($order[0]->ord_reqdate)) ?></div>
                    <div class="details-to">
                        <?php echo $order[0]->cust_name ?> <br>
                        <?php echo $order[0]->cust_billaddress ?> <br>
                        <?php echo $order[0]->cust_city .', '.$order[0]->cust_state .' .'.$order[0]->cust_zip ?>
                    </div>
                    <div class="details-amount">
                        $ <?php echo $order[0]->ord_subtotal ?><br>
                        $ <?php echo $order[0]->ord_shipping ?> <br><br>
                        $ <?php echo $order[0]->ord_total ?> <br>
                    </div>
                    <div class="details-number">
                        <?php echo $order[0]->ord_orderclient ?>
                    </div>
                    <div class="details-shipp">
                        <?php echo $order[0]->shdesc ?>
                    </div>
                </td>
            </tr>
        </table>
        </div>
    </page_footer>
    <table style="width: 100%;border: solid 1px #5544DD; border-collapse: collapse" align="center">
        <thead>
        <tr>
            <th class="title">Description</th>
            <th class="title">File name</th>
            <th class="title">Part#</th>
            <th class="title" style="width: 60px !important;">Qty.</th>
            <th class="title">Unit Price</th>
            <th class="title">Disc %</th>
            <th class="title title-amount">Amount</th>
            <th></th>
        </tr>
        <tr>
            <td colspan="7" style="padding-top: 10px;padding-bottom: 10px;">
                <div style="border-top: 1px solid #b3b1ad;"></div>
            </td>
        </tr>
        </thead>
        <tbody>
            <?php
                $tot_cant = 0;
                $tot_amount = 0;
                $tot_items = 2;
            ?>
            <?php foreach ($order as $ord) {
                $tot_cant = $tot_cant  + $ord->ord_qty;
                $tot_desc = $ord->ord_disc;
                $tot_amount = $tot_amount + $ord->ord_amount;
            ?>


            <tr>
                <td class="description sep-column"><?php echo $ord->part_name; ?></td>
                <td class="file-name sep-column"><?php echo $ord->ord_id.'-'.$ord->ord_det ?></td>
                <td class="part sep-column"><?php echo $ord->part_code ?></td>
                <td class="qty sep-column"><?php echo $ord->ord_qty ?></td>
                <td class="sep-column">
                    <div class="price"><?php echo money_format('%.2n', $ord->ord_uprice) ?></div>
                </td>
                <td class="disc sep-column"><?php echo $ord->ord_disc?></td>
                <td><div style="width: 80px; text-align: right;"><?php echo money_format('%.2n', $ord->ord_amount) ?></div></td>
            </tr>
                <tr>
                    <td colspan="7" style="padding-top: 10px;padding-bottom: 10px;">
                        <div style="border-top: 1px solid #b3b1ad;"></div>
                    </td>
                </tr>
            <?php } ?>

            <tr>
                <td></td>
                <td></td>
                <td class="part sep-column">TOTAL</td>
                <td class="qty sep-column"><?php echo $tot_cant ?></td>
                <td class="sep-column">
                </td>
                <td class="disc sep-column"><?php echo $tot_desc ?></td>
                <td><div style="width: 80px; text-align: right;"><?php echo money_format('%.2n', $tot_amount) ?></div></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="border-bottom: 1px solid #b3b1ad;"></td>
                <td style="border-bottom: 1px solid #b3b1ad;"></td>
                <td style="border-bottom: 1px solid #b3b1ad;"></td>
                <td style="border-bottom: 1px solid #b3b1ad;"></td>
                <td style="border-bottom: 1px solid #b3b1ad;"></td>
            </tr>
        </tbody>
        <tfoot>
        <tr>

        </tr>
        </tfoot>
    </table>

</page>