class Input {
    #input="";

    constructor(type_input, name_html, name_php, extra_tags="", extra_css="") {
        if(name_html != undefined) {
            this.#input += `<label for="${name_php}">${name_html}</label>`;
        }
        this.#input += `<input type="${type_input}" name="${name_php}" style="${extra_css}" ${extra_tags} />`;
    }

    getInput() {
        return this.#input;
    }
}

function newFormDialog(name_php_request, list_inputs) {
    list_inputs.push(new Input("submit", undefined, "dialog"));

    let cnt = `<div class='dialog-win'> <form action='index.php' method='POST'>`;

    list_inputs.forEach(input => {
        cnt += input.getInput();
    });
    cnt += "</form></div>";
    $("body").append(cnt);
}