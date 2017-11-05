$(document).ready(function(){
  aler("testing");
  var db = {
    loadData: function(filter) {
      return $.grep(this.users, function(user) {
        return (!filter.username || user.username.indexOf(filter.username) > -1);
      });
    }
  }

  db.users = "<?php echo $users ?>";

  $("#grid").jsGrid({
    filtering: true,
    editing: false,
    sorting: true,
    autoload: true,

    controller: "<?php echo $users ?>",

    fields: [
      { name: "username", type: "text", textField: "Username" },
      { name: "email", type: "text", textField: "Email" },
      { name: "isActive", type: "number", textField: "is Active" }
    ]
  });
});
