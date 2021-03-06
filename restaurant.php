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

$sql_menu_pic = "SELECT * FROM menu_pictures";
$all_menu_pic = $pdo->query($sql_menu_pic)->fetchAll();

$sql_sp_menu = "SELECT * FROM special_menu";
$all_sp_menu = $pdo->query($sql_sp_menu)->fetchAll();

?>
<?php include __DIR__ . '\parts\__head.php'?>
<?php include __DIR__ . '\parts\__navbar.html'?>
<?php include __DIR__ . '\parts\__sidebar.html'?>

<?php include __DIR__ . '\parts\__main_start.html'?>
<!-- 主要的內容放在 __main_start 與 __main_end 之間 -->
<!-- table -->
<div class="d-flex justify-content-between mt-5">
    <div>
    <button type="button" class="btn btn-secondary btn-sm" onclick="deleteMany()">刪除選擇項目</button>
    <button type="button" class="btn btn-secondary btn-sm" onclick="location.href='restaurant_add.php'">新增合作餐廳</button>
    </div>
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
                    <input class="form-check-input" type="checkbox" value="" id="isAll"/>
                </th>
                <th style="flex: 0 0 auto; width: 3%; text-align: center">
                    刪除
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
                <th class="col-2">餐廳圖片</th>
                <th class="col-2">菜單圖片</th>
                <th class="col-2">特別菜單</th>
                <th style="flex: 0 0 auto; width: 3%; text-align: center">
                    編輯
                </th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($rows as $r) { ?>
            <tr class="d-flex">
                <td>
                    <input class="form-check-input check" type="checkbox" value="<?= $r['res_id']?>" />
                </td>
                <td style="flex: 0 0 auto; width: 3%; text-align: center">
                    <a href="javascript: delete_it(<?=$r['res_id']?>)"><i class="fas fa-trash"></i></a>
                </td>
                <td><?= htmlentities($r['res_id']) ?></td>
                <td class="col-1"><?= htmlentities($r['res_type']) ?></td>
                <td class="col-1"><?= htmlentities($r['res_area']) ?></td>
                <td class="col-1"><?= htmlentities($r['res_name']) ?></td>
                <td class="col-1"><?= htmlentities($r['res_intro']) ?></td>
                <td class="col-1"><?= htmlentities($r['res_address']) ?></td>
                <td class="col-3" data-time="<?= $r['res_id']?>"></td>
                <td class="col-1" style="overflow-wrap: break-word;"><?= htmlentities($r['res_t_number']) ?></td>
                <td class="col-1" style="overflow-wrap: break-word;"><?= htmlentities($r['web_link']) ?></td>
                <td class="col-1" style="overflow-wrap: break-word;"><?= htmlentities($r['fb_link']) ?></td>
                <td class="col-1" style="overflow-wrap: break-word;"><?= htmlentities($r['ig_link']) ?></td>
                <td class="col-1" style="overflow-wrap: break-word;"><?= htmlentities($r['booking_link']) ?></td>
                <td class="col-2" data-respic="<?= $r['res_id']?>"></td>
                <td class="col-2" data-menupic="<?= $r['res_id']?>"></td>
                <td class="col-2" data-spmenu="<?= $r['res_id']?>"></td>
                <td style="flex: 0 0 auto; width: 3%; text-align: center">
                    <a href="restaurant_edit.php?res_id=<?= $r['res_id']?>"><i class="fas fa-pen"></i></a>
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
    const modalBody = document.querySelector('.modal-body');
    const tds = document.querySelectorAll('td');

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

    // 刪除資料
    function delete_it(res_id){
        modalBody.innerHTML = `確定要刪除編號為 ${res_id} 的資料嗎？`;
        document.querySelector('.modal-footer').innerHTML = `<a href="delete-many.php?res_id=${res_id}" class="btn btn-secondary">刪除</a>`;
        modal.show();
    }
    function deleteMany(){
        let checked = [];
        let resId = [];
        let newString = '';
        for(let i = 0; i<check.length;i++) {
        if(check[i].checked == true) {
            checked.push(check[i]);
          }
        }
        for (let i = 0; i<checked.length;i++) {
            resId.push(checked[i].value);
        }
        newString = resId.join(",")
        if(resId.length == 0) {
            modalBody.innerHTML = `目前尚未選取項目。`;
            document.querySelector('.modal-footer').innerHTML = `<button type="button" onclick="modal.hide()" class="btn btn-secondary">確認</button>`;
            modal.show();
        } else {
            delete_it(newString)
        }
    }

    const all = <?= json_encode($all) ?>;  // 將資料庫資料送到前端
    const allResPic = <?= json_encode($all_res_pic) ?>;  // 將餐廳圖片資料庫資料送到前端
    const allMenuPic = <?= json_encode($all_menu_pic) ?>;  // 將餐廳圖片資料庫資料送到前端
    const allSpMenu = <?= json_encode($all_sp_menu) ?>;  // 將餐廳圖片資料庫資料送到前端

    // render 營業時間
    for (let i = 0; i< all.length; i++) {
        tds.forEach(td => {
            if(td.dataset.time == all[i].res_id) {
                let parse = JSON.parse(all[i].res_ser_hours);
                document.querySelector(`[data-time="${td.dataset.time}"]`).innerHTML = `
                <select class="form-select form-select-sm" aria-label="Default select example">
                <option value="1">星期一 ${parse[2]}</option>
                <option value="2">星期二 ${parse[3]}</option>
                <option value="3">星期三 ${parse[4]}</option>
                <option value="4">星期四 ${parse[5]}</option>
                <option value="5">星期五 ${parse[6]}</option>
                <option value="6">星期六 ${parse[0]}</option>
                <option value="7">星期日 ${parse[1]}</option>
                </select>
                `
            }
        })
    }
    const options = document.querySelectorAll('option');
    let today = new Date().getDay();
    options.forEach(option=> {
        if (option.value == today) { option.selected = true}   // 如果是今天，顯示今天的時間
    })

    // render 餐廳圖片
    for (let i = 0; i<allResPic.length; i++) {
        tds.forEach(td => {
            if(td.dataset.respic == allResPic[i].res_id) {
                document.querySelector(`[data-respic="${td.dataset.respic}"]`).innerHTML += `
                <img style="width:100px; object-fit:cover; margin-bottom:1rem" src="./img/res_pic/${allResPic[i].res_pic_name}">
                `
            }
        })
    }

    // render 菜單圖片
    for (let i = 0; i<allMenuPic.length; i++) {
        tds.forEach(td => {
            if(td.dataset.menupic == allMenuPic[i].res_id) {
                document.querySelector(`[data-menupic="${td.dataset.menupic}"]`).innerHTML += `
                <img style="width:100px; object-fit:cover; margin-bottom:1rem" src="./img/menu_pic/${allMenuPic[i].menu_pic_name}">
                `
            }
        })
    }

    // render 特別菜單
    for (let i = 0; i<allSpMenu.length; i++) {
        tds.forEach(td => {
            if(td.dataset.spmenu == allSpMenu[i].res_id) {
                document.querySelector(`[data-spmenu="${td.dataset.spmenu}"]`).innerHTML += `

                <div class="card" style="width: 10rem;">
                  <img src="./img/sp_menu/${allSpMenu[i].sp_menu_pic_name}" class="card-img-top">
                  <div class="card-body">
                    <p class="card-text">${allSpMenu[i].sp_menu_name}</p>
                  </div>
                </div>
                `
            }
        })
    }


    // const url = new URL(location.href);
    // const param = new URLSearchParams(url.search);
    // let page = param.get('page');   // 將 query string "page" 送到前端

    
</script>
<?php include __DIR__ . '\parts\__foot.html'?>