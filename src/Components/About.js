import React, { Component } from 'react';

class About extends Component {
   render() {

      if(this.props.data){
         var name = this.props.data.contact.name;
         var profilepic= "images/" + this.props.data.contact.image;
         var bio = this.props.data.contact.bio;
         var city = this.props.data.contact.address.city;
         var state = this.props.data.contact.address.state;
      }

      return (
         <div className="background-white">
            <div id="profile" className="container">
               <h2>Profile</h2>
               <hr/>
               <div className="row">
                  <div className="col-md-4 text-center">
                     <img src={profilepic} alt="Pokedingus" width="246" height="246" />
                  </div>					
               </div>
               <div className="row">
                  <div className="col-md-8">
                     <h3>About us</h3>
                     <p>{bio}</p>
                  </div>					
               </div>
            </div>	
         </div>
      );
   }
}

export default About;
