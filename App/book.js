var ab = {
  // (A) HTML ELEMENTS
  hWrap : null, // address book list wrapper
  hList : null, // address book list
  hForm : null, // address book form
  hfName : null, // name field
  hfEmail : null, // email field
  hfTel : null, // tel field
  hfAddr : null, // address field
  hfID : null, // id field

  // (B) INIT - GET HTML ELEMENTS + LOAD LIST
  init : () => {
    ab.hWrap = document.getElementById("abWrap");
    ab.hList = document.getElementById("abList");
    ab.hForm = document.getElementById("abForm");
    ab.hfName = document.getElementById("abName");
    ab.hfEmail = document.getElementById("abEmail");
    ab.hfTel = document.getElementById("abTel");
    ab.hfAddr = document.getElementById("abAddr");
    ab.hfID = document.getElementById("abID");
    ab.list();
  },

  // (C) HELPER - AJAX FETCH
  ajax : (data, after) => {
    // (C1) FORM DATA
    let form = new FormData();
    for (let [k,v] of Object.entries(data)) { form.append(k,v); }

    // (C2) AJAX FETCH
    fetch("ajax.php", { method:"post", body:form })
    .then(res => res.text())
    .then(res => after(res))
    .catch(err => console.error(err));
  },

  // (D) TOGGLE HTML SECTION
  tog : id => {
    // (D1) ADD/EDIT ADDRESS BOOK ENTRY
    if (id)  {
      ab.hWrap.classList.add("hide");
      ab.hForm.classList.remove("hide");
      ab.hForm.reset();
      if (Number.isInteger(id)) {
        ab.ajax({ req : "get", id : id }, e => {
          e = JSON.parse(e);
          ab.hfName.value = e.name;
          ab.hfEmail.value = e.email;
          ab.hfTel.value = e.tel;
          ab.hfAddr.value = e.address;
          ab.hfID.value = id;
        });
      } else { ab.hfID.value = ""; }
    }

    // (D2) SHOW ADDRESS BOOK LIST
    else {
      ab.hForm.classList.add("hide");
      ab.hWrap.classList.remove("hide");
    }
  },

  // (E) LOAD ADDRESS BOOK LIST
  list : () => ab.ajax({ req : "get" }, entries => {
    ab.tog();
    entries = JSON.parse(entries);
    ab.hList.innerHTML = "";
    if (entries.length>0) { for (let e of entries) {
      let row = document.createElement("div");
      row.className = "row";
      row.innerHTML = '<div class="rInfo">
        <div class="rOne">${e.name}</div>
        <div class="rTwo">${e.email} | ${e.tel}</div>
        <div class="rTwo">${e.address}</div>
      </div>
      <button class="rBtn" onclick="ab.del(${e.id})">X</button>
      <button class="rBtn" onclick="ab.tog(${e.id})">&#9998;</button>';
      ab.hList.appendChild(row);
    }}
  }),

  // (F) SAVE ADDRESS BOOK ENTRY
  save : () => {
    // (F1) FORM DATA
    let data = {
      req : "save",
      name : ab.hfName.value,
      email : ab.hfEmail.value,
      tel : ab.hfTel.value,
      addr : ab.hfAddr.value,
      id : ab.hfID.value
    };
    if (data.id=="") { delete data.id; }

    // (F2) AJAX SAVE
    ab.ajax(data, res => {
      if (res=="OK") { ab.list(); }
      else { alert(res); }
    });
    return false;
  },

  // (G) DELETE ADDRESS BOOK ENTRY
  del : id => { if (confirm("Delete entry?")) {
    ab.ajax({ req : "del", id : id }, res => {
      if (res=="OK") { ab.list(); }
      else { alert(res); }
    });
  }}
};
window.onload = ab.init;