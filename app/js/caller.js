function connectDatabase() {
    let list = [
        new Input("number", "NUMBER", "num", "", "color: red;"),
        new Input("text", "Tusername", "user", "value='Hello'", "color: green;")
    ];
    
    newFormDialog("Test php request", list);
}

function disconnect() {

}

function refresh() {

}

function exportAction() {

}

function ownSQL() {

}

function callTable(name) {
    console.log(`Tabel ${name} has been called`);
}