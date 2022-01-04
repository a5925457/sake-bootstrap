<?php require __DIR__. '\parts\__connect_db.php';
$title = "合作餐廳列表";
$pageName = "restaurant_list";

$sql_t = "SELECT COUNT(1) FROM restaurant";
$total = $pdo->query($sql_t)->fetch(PDO::FETCH_NUM)[0];

$perPage = 5;   // 每頁 5 筆
$totalPages = ceil($total/$perPage);   // 算總頁數

$page = isset($_GET['page']) ? intval($_GET['page']) : 1 ;  // 這邊使用 $_GET 接收query string，若沒有值則為1（第一頁）

if ($page < 1) {
    header('Location: restaurant.php');
    exit;
    }
  
if ($page > $totalPages) {
    header('Location: restaurant.php?page=' . $totalPages);
    exit;
    }

$sql = sprintf("SELECT * FROM restaurant LIMIT %s, %s", ($page-1)*5, $perPage);
$rows = $pdo->query($sql)->fetchAll();

$sql_all = "SELECT * FROM restaurant";
$all = $pdo->query($sql_all)->fetchAll();

$sql_res_pic = "SELECT * FROM restaurant_pictures";
$all_res_pic = $pdo->query($sql_res_pic)->fetchAll();

?>
<?php include __DIR__ . '\parts\__head.php'?>
<?php include __DIR__ . '\parts\__navbar.html'?>
<?php include __DIR__ . '\parts\__sidebar.html'?>

<?php include __DIR__ . '\parts\__main_start.html'?>
<!-- 主要的內容放在 __main_start 與 __main_end 之間 -->
<!-- table -->
<div class="d-flex justify-content-between mt-5">
    <button type="button" class="btn btn-secondary btn-sm">刪除選擇項目</button>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?= 1==$page ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page-5 ?>"><i class="fas fa-angle-double-left"></i></a>
            </li>
            <li class="page-item <?= 1==$page ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page-1 ?>"><i class="fas fa-angle-left"></i></a>
            </li>
            <?php for($i=1; $i<=$totalPages; $i++): ?>  
              <li class="page-item <?= $page==$i? 'active' : ''?>"><a class="page-link" href="?page=<?=$i?>"><?= $i ?></a></li>
            <?php endfor ?>
            <li class="page-item <?= $totalPages==$page ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page+1 ?>"><i class="fas fa-angle-right"></i></a>
            </li>
            <li class="page-item <?= $totalPages==$page ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page+5 ?>"><i class="fas fa-angle-double-right"></i></a>
            </li>
        </ul>
    </nav>
</div>
<div class="table-responsive" style="overflow-x: scroll; height: 80vh;">
<!-- table style 是為了讓表格的卷軸顯示在比較明顯的位置 -->
    <table class="table table-striped table-sm">
        <thead>
            <tr class="d-flex">
                <th>
                    <input class="form-check-input" type="checkbox" value="" id="isAll" />
                </th>
                <th>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </th>
                <th>#</th>
                <th class="col-1">餐廳類型</th>
                <th class="col-1">餐廳地區</th>
                <th class="col-1">餐廳名稱</th>
                <th class="col-1">餐廳介紹</th>
                <th class="col-1">餐廳地址</th>
                <th class="col-3">營業時間</th>
                <th class="col-1">餐廳電話</th>
                <th class="col-1">餐廳官網</th>
                <th class="col-1">餐廳FB</th>
                <th class="col-1">餐廳IG</th>
                <th class="col-1">訂位網址</th>
                <th class="col-1">建立時間</th>
                <th class="col-1">更新時間</th>
                <th>
                    <a href="#"><i class="fas fa-pen"></i></a>
                </th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($rows as $r) { ?>
            <tr class="d-flex">
                <td>
                    <input class="form-check-input check" type="checkbox" value="" />
                </td>
                <td>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </td>
                <td><?= htmlentities($r['res_id']) ?></td>
                <td class="col-1"><?= htmlentities($r['res_type']) ?></td>
                <td class="col-1"><?= htmlentities($r['res_area']) ?></td>
                <td class="col-1"><?= htmlentities($r['res_name']) ?></td>
                <td class="col-1"><?= htmlentities($r['res_intro']) ?></td>
                <td class="col-1"><?= htmlentities($r['res_address']) ?></td>
                <td class="col-3 res-ser-hours"><?= htmlentities($r['res_ser_hours']) ?></td>
                <td class="col-1"><?= htmlentities($r['res_t_number']) ?></td>
                <td class="col-1" style="overflow-wrap: break-word;"><?= htmlentities($r['web_link']) ?></td>
                <td class="col-1" style="overflow-wrap: break-word;"><?= htmlentities($r['fb_link']) ?></td>
                <td class="col-1" style="overflow-wrap: break-word;"><?= htmlentities($r['ig_link']) ?></td>
                <td class="col-1" style="overflow-wrap: break-word;"><?= htmlentities($r['booking_link']) ?></td>
                <td class="col-1"><?= htmlentities($r['res_create_date']) ?></td>
                <td class="col-1"><?= htmlentities($r['res_update_date']) ?></td>
                <td>
                    <a href="#"><i class="fas fa-pen"></i></a>
                </td>
            </tr>
            <tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '\parts\__main_end.html'?>

<!-- 如果要 modal 的話留下面的結構 -->
<?php include __DIR__ . '\parts\__modal.html'?>

<?php include __DIR__ . '\parts\__script.html'?>
<!-- 如果要 modal 的話留下面的 script -->
<script>
    const modal = new bootstrap.Modal(document.querySelector('#exampleModal'));
    //  modal.show() 讓 modal 跳出;

    const isAll = document.querySelector("#isAll");
    const check = document.querySelectorAll(".check");
    let v = false;
    isAll.addEventListener("click", function() {
        if (v == false) {
            for (let i = 0; i<check.length; i++) {
                check[i].checked = true
            }
            v = true
        } else {
            for (let i = 0; i<check.length; i++) {
                check[i].checked = false
            }
            v = false
        }
    })

    const all = <?= json_encode($all) ?>;  // 將資料庫資料送到前端
    const allResPic = <?= json_encode($all_res_pic) ?>;  // 將資料庫資料送到前端
    
    const time = all.map(item => {
        return JSON.parse(item.res_ser_hours)   // 將時間資料轉為 JSON 格式
    })
    const serviceHour = document.querySelectorAll('.res-ser-hours');

    const url = new URL(location.href);
    const param = new URLSearchParams(url.search);
    let page = param.get('page');   // 將 query string "page" 送到前端

    if (page == 1 || !page) {
        for (let i = 0; i<5; i++) {
        serviceHour[i].innerHTML = `
        <select class="form-select form-select-sm" aria-label="Default select example">
        <option value="1">星期一 ${time[i][2]}</option>
        <option value="2">星期二 ${time[i][3]}</option>
        <option value="3">星期三 ${time[i][4]}</option>
        <option value="4">星期四 ${time[i][5]}</option>
        <option value="5">星期五 ${time[i][6]}</option>
        <option value="6">星期六 ${time[i][0]}</option>
        <option value="7">星期日 ${time[i][1]}</option>
        </select>
        `;
     }
    } 
    if (page == 2) {
        for (let i = 0; i<5; i++) {
        serviceHour[i].innerHTML = `
        <select class="form-select form-select-sm" aria-label="Default select example">
        <option value="1">星期一 ${time[i+5][2]}</option>
        <option value="2">星期二 ${time[i+5][3]}</option>
        <option value="3">星期三 ${time[i+5][4]}</option>
        <option value="4">星期四 ${time[i+5][5]}</option>
        <option value="5">星期五 ${time[i+5][6]}</option>
        <option value="6">星期六 ${time[i+5][0]}</option>
        <option value="7">星期日 ${time[i+5][1]}</option>
        </select>
        `;
        }
    } 
    if (page == 3) {
        for (let i = 0; i<serviceHour.length; i++) {
        serviceHour[i].innerHTML = `
        <select class="form-select form-select-sm" aria-label="Default select example">
        <option value="1">星期一 ${time[i+10][2]}</option>
        <option value="2">星期二 ${time[i+10][3]}</option>
        <option value="3">星期三 ${time[i+10][4]}</option>
        <option value="4">星期四 ${time[i+10][5]}</option>
        <option value="5">星期五 ${time[i+10][6]}</option>
        <option value="6">星期六 ${time[i+10][0]}</option>
        <option value="7">星期日 ${time[i+10][1]}</option>
        </select>
        `;
        }
    }

    const options = document.querySelectorAll('option');
    let today = new Date().getDay();
    options.forEach(option=> {
        if (option.value == today) { option.selected = true}   // 如果是今天，顯示今天的時間
    })

</script>
<?php include __DIR__ . '\parts\__foot.html'?>