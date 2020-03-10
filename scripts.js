
let current_number;
let client_body = document.getElementById('clienttbody');


getPhoneNumber().then((number) => {
    current_number = number;
    getClients().then((clients) => {

        clients.forEach(client => {
            makeClientRowNode(client);
        })
    })

});






async function getClients() {
    const response = await fetch('api/?route=clients');

    if (response.ok) {
        const clients = await response.json();



        return clients;
    } else {
        const error = await response.json();
        throw error;
    }
}

async function getPhoneNumber() {
    const response = await fetch('api/?route=phone');
    const cont = document.getElementById('current_phone');
    if (response.ok) {
        const body = await response.json();
        const number = body.number;
        cont.innerHTML = number;
        return number;
    } else {
        const error = await response.json();
        cont.innerHTML = error;
        throw error;
    }
}



async function setPhoneNumber(num) {
    const data = { number: num };
    const options = {
        method: 'POST',
        body: JSON.stringify(data)
    }
    let response = await fetch('api/?route=phone', options);
    if (response.ok) {
        const data = await response.json();
        return data;
    } else {
        const error = await response.json();
        throw error;
    }
}
async function deleteClient(clientid) {

    const options = {
        method: 'DELETE'
    }
    let response = await fetch(`api/?route=clients&id=${clientid}`, options);
    if (response.ok) {
        return true;
    } else {
        const error = await response.json();
        throw error;
    }
}


async function addClient(client) {

    const options = {
        method: 'POST',
        body: JSON.stringify(client)
    }
    let response = await fetch(`api/?route=clients`, options);
    if (response.ok) {
        const data = await response.json();
        return data;
    } else {
        const error = await response.json();
        throw error;
    }
}




// setTimeout(() => {
//     const c = {
//         first_name: 'bob',
//         last_name: 'bob',
//         phone: '123',
//         company_name: '',
//     }
//     addClient(c).then(newclient => {
//         makeClientRowNode(newclient);
//     });
// }, 5000)



const callbuttons = document.getElementsByClassName('call_button');
for (let i = 0; i < callbuttons.length; i++) {
    const callbutton = callbuttons[i];

    callbutton.addEventListener('click', function (e) {
        e.preventDefault();
        const number = callbutton.dataset['number'];
        const setp = setPhoneNumber(number);
        setp.then((data) => {
            getPhoneNumber();
        })
    })
}


function removeSelectedClass() {
    // remove this row from the table
    client_body.childNodes.forEach(node => {
        if (node.classList) {
            node.classList.remove('selected');
        }

    })
}


function makeClientRowNode(client) {

    var node = document.createElement("TR");


    fields = ['phone', 'first_name', 'last_name', 'company_name'];

    fields.forEach(field => {
        var td1 = document.createElement("TD");
        td1.innerText = client[field];
        node.appendChild(td1);
    })


    const tdb = document.createElement("TD");
    const butcon = document.createElement("DIV");
    butcon.classList.add('button_container');
    const numa = document.createElement("A");
    numa.classList.add('call_button');
    numa.classList.add('button');
    numa.innerHTML = 'Call';
    numa.addEventListener('click', function () {
        setPhoneNumber(client.phone).then(() => {
            removeSelectedClass();
            node.classList.add('selected');
            getPhoneNumber();
        });
    })

    if (current_number == client.phone) {
        node.classList.add('selected');
    }


    const numd = document.createElement("A");
    numd.classList.add('delete');
    numd.innerHTML = 'X';
    numd.addEventListener('click', function () {
        if (confirm('Are you sure?')) {
            deleteClient(client.id).then(() => {
                // remove this row from the table
                const client_body = document.getElementById('clienttbody');
                client_body.removeChild(node);
            });
        }

    })


    butcon.appendChild(numa);
    butcon.appendChild(numd);
    tdb.appendChild(butcon);
    node.appendChild(tdb);

    client_body.appendChild(node);

    return node;
}