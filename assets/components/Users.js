import React, {Component} from 'react';
import axios from 'axios';
import Modal from 'react-modal';
import Attributions from './Attributions';
class postes extends Component {
    constructor() {
        super();
        this.state = {attributions:[], listepostes: [],show: false,jour:new Date().toISOString().substr(0, 10), nomPoste:"",loading: true};
        this.getPostes=this.getPostes.bind(this);
        this.openModal=this.openModal.bind(this);
        this.closeModal=this.closeModal.bind(this);
        this.ajoutPoste=this.ajoutPoste.bind(this);
    }
    
    componentDidMount() {
        this.getPostes();
    }
    
    getPostes(e) {

  axios.get('http://localhost:8000/api/postes', {
    params: {
        date: this.state.jour,
    }
}).then(postes => {

        
          // var t=Object.keys(postes.data).map((key) => postes.data[key]);
 console.log(postes.data);
          // this.setState({ listepostes: postes[0], loading: false})
           
       })
    }

    openModal (e) {

        this.setState({ show: true });
   
      };
    
      closeModal ()  {
        this.setState({ show: false });
      };

    ajoutPoste(){
        axios({ 
            url:"http://localhost:8000/postes/add",
            method:"post",
            data:{ 
              nomPoste:this.state.nomPoste,
            } 
          }).then(msg=>{
            this.setState({ show: false });
            this.getPostes();
            console.log("ok");
          })
    }
    render() {
        const loading = this.state.loading;
        return(
            <div>
               
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center"><span>List of postes</span>Created with <i
                                className="fa fa-heart"></i> by yemiwebby</h2>
                        </div>
                        <input type="date" onChange={this.getPostes}/>

                        <button onClick={this.openModal} >Ajout poste</button>
                        {loading ? (
                            <div className={'row text-center'}>
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
                        ) : (
                            <div className='row d-flex flex-row flex-warp'>
           <Modal isOpen={this.state.show} onRequestClose={this.closeModal}>
          <button onClick={this.closeModal}>close</button>
          <input type="text" id="postes" onInput={(e)=>this.setState({nomPoste:e.target.value})}/>
  
          <button onClick={this.ajoutPoste}>ajouter</button>
        </Modal>
                      { 
                                this.state.listepostes.map(p =>
                                    <div className="col-md-3 offset-md-1 row-block card" key={p.id}>
                                    <div className="card-body">
                                            {p.nomPoste}
                                   

                                        <Attributions posteId={p.id} Attributions={p.attributions}  key={p.id}/>
                                       </div>   
                                      
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </section>
            </div>
        )
    }
}
export default postes;