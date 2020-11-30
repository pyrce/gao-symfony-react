import React, { Component } from 'react';
import { render } from 'react-dom';
import Modal from 'react-modal';
import axios from 'axios';

class Attributions extends Component {
    constructor(props) {
        super(props);
        this.state = { heures:[7,8,9,10,11,12,13,14,15,16,17],pc:"",nomClient:"",prenomClient:"", heure:"",clientId:"",listes:[],clients:[], show: false,loading: true};
        
        this.ajout=this.ajout.bind(this);
        this.content=this.content.bind(this);
        this.openModal=this.openModal.bind(this);
        this.closeModal=this.closeModal.bind(this);
        this.populate=this.populate.bind(this);
        this.attribuer=this.attribuer.bind(this);
        this.register=this.register.bind(this);
        this.ajoutClient=this.ajoutClient.bind(this);
    }

    ajout(e){

        
           axios({
            method: 'post',
            url: '/api/attributions/delete',
            data: {
              id: e.target.dataset.id
            }
          }).then(msg=>{
            console.log("attr")
          });
        
    }
    attribuer(){

      axios({ 
        url:"/api/attributions/add",
        method:"post",
        data:{ 
          pc:this.state.pc,
          client:this.state.clientId,
          heure:this.state.heure 
        } 
      }).then(msg=>{
       this.closeModal();
        console.log("ok");
      })

    }

    register(e){
     
      let inputValue = document.getElementById("clients").value;
      let option = document.querySelector(`option[value="${inputValue}"]`).dataset["idclient"];
      this.setState({clientId:option});
    }
populate(){
  axios.get("/api/clients").then(data=>
  {
   var t=[];
    data.data.map(d=>{
      t.push(<option data-idclient={d.id} value={d.nomClient+"-"+d.prenomClient} key={d.id}>{d.nomClient+"-"+d.prenomClient}</option>)
    })
    console.log(t);
    this.setState({clients:t});
   } )
}
ajoutClient(){
  axios({ 
    url:"/api/clients/add",
    method:"post",
    data:{ 
      nomClient:this.state.nomClient,
      prenomClient:this.state.prenomClient,

    } 
  }).then(msg=>{
   

  })
}
          content({posteId,attr}){

var nom=[];
var r=0;

this.state.heures.map(h=>{
  if(typeof attr!="undefined"){
 r=attr.filter(
  item =>
  item.heure==h
)

    if(r.length>0){
            nom.push( <div className="horaires col-12"> <span className="col-5" key={h}> {h} h </span><span className="col-7"> { r[0].nom_client+" "+r[0].prenom_client }  </span><button className="btn btn-warning" onClick={this.ajout}  data-param="delete" data-id={r[0].id}> - </button></div>)
          }else {
          nom.push(   <div className="horaires col-12"><span  className="col-5" key={h}>{h} h</span> <span className="col-7"></span> <button  className="btn btn-primary" onClick={this.openModal} data-horaire={h}   data-pc={posteId} data-param="ajout"> + </button> </div>)
        }

           } else {
            nom.push(   <div className="horaires col-12"><span  className="col-5" key={h}>{h} h</span> <span className="col-7"></span> <button  className="btn btn-primary" onClick={this.openModal} data-horaire={h}   data-pc={posteId} data-param="ajout"> + </button> </div>)

          }   } )
          
          
return nom;

    }

      openModal (e) {

        this.setState({ show: true,heure: e.target.dataset.horaire,pc:e.target.dataset.pc });
   
      };
    
      closeModal ()  {
        this.setState({ show: false });
      };
    render() {
        const loading = this.state.loading;


        return(
            <div className="d-flex flex-column">

            <Modal isOpen={this.state.show} onRequestClose={this.closeModal}>
          <button onClick={this.closeModal}>close</button>
          <input type="text" id="clients" list="nom" onInput={this.populate} onChange={this.register} />
          <datalist id="nom" >
{this.state.clients}
          </datalist>
          <button onClick={this.attribuer}>attribuer</button>

          <section>
            <input type="text" onChange={(e=>{this.setState({nomClient:e.target.value}) })}/> <br/>
            <input type="text" onChange={(e=>{this.setState({prenomClient:e.target.value}) })}/>  <br/>
            <button onClick={this.ajoutClient}>ajout client</button>
          </section>

        </Modal>

                  
                  <this.content posteId={this.props.posteId}  attr={this.props.Attributions} />


      
            </div>
        )
    }


}
export default Attributions;