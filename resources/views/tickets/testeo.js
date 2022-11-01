const { functionsIn } = require("lodash");

var f_ticket = [{
    id: 1,
    user_report: 1,
    type: 'Abierto',
    date: '2022-09-22',
    ticket_report: 'adasdf',
    employer: 'adsfsdf',
    closed_at: '2022-09-23',
    date_finish: '2022-09-23',
    hour_finish: '17:10:32',
    created_at: '2022-09-23 13:10:32',
    updated_at: '2022-09-22 13:10:32'
  },

  {
    id: 2,
    user_report: 1,
    type: 'Abierto',
    date: '2022-09-22',
    ticket_report: 'adasdf',
    employer: 'adsfsdf',
    closed_at: '2022-09-23',
    date_finish: '2022-09-23',
    hour_finish: '17:10:32',
    created_at: '2022-09-23 13:10:32',
    updated_at: '2022-09-22 13:10:32'
  },

  {
    id: 3,
    user_report: 1,
    type: 'Cerrado',
    date: '2022-09-22',
    ticket_report: 'adasdf',
    employer: 'adsfsdf',
    closed_at: '2022-09-23',
    date_finish: '2022-09-23',
    hour_finish: '17:10:32',
    created_at: '2022-09-23 13:10:32',
    updated_at: '2022-09-22 13:10:32'
  },

  {
    id: 4,
    user_report: 1,
    type: 'Cerrado',
    date: '2022-09-22',
    ticket_report: 'adasdf',
    employer: 'adsfsdf',
    closed_at: '2022-09-23',
    date_finish: '2022-09-23',
    hour_finish: '17:10:32',
    created_at: '2022-09-23 13:10:32',
    updated_at: '2022-09-23 13:10:32'
  }
];
var array_final=[];

for (let pasada_general of f_ticket) {
//[fecha,totalabierto,total cerrado]
  var arreglo_interno1 = ['', 0, 0];

  switch (pasada_general.type) {
    case 'Abierto':
      
      arreglo_interno1[0] = pasada_general.updated_at.slice(0,11);
      arreglo_interno1[1] = 1;
      break;
    case 'Cerrado':

      arreglo_interno1[0] = pasada_general.updated_at.slice(0,11);
      arreglo_interno1[2] = 1;
      break;
    default:
      console.log('Nothing here')
  }
  array_final.push(arreglo_interno1)
}

let resp = [];
array_final.forEach(el=>{
    let index = resp.findIndex(date=> date[0] == el[0]);
    if(index>=0){
        resp[index] = [el[0], resp[index][1]+el[1], resp[index][2]+el[2]];
    }else{
        resp.push(el);
    }
})  
console.log(resp)

