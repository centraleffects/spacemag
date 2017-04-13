<div class="fixed-action-btn">
  <a class="btn-floating btn-large red">
    <i class="large material-icons">mode_edit</i>
  </a>
  <ul>
    <li>
        <a href="#!" onClick="newUser()" class="btn-floating red tooltipped waves-effect waves-light" data-position="left" data-delay="50" data-tooltip="New User">
            <i class="material-icons">face</i>
        </a>
    </li>
    <li ng-controller="adminShopController">
        <a class="btn-floating yellow darken-1 tooltipped waves-effect waves-light" data-position="left" data-delay="50" data-tooltip="New Shop">
            <i class="material-icons">store</i>
        </a>
    </li>
    <li>
        <a class="btn-floating green tooltipped waves-effect waves-light" data-position="left" data-delay="50" data-tooltip="New Category">
            <i class="material-icons">list</i>
        </a>
     </li>
  </ul>
</div>