import React, { Component } from 'react';

class Abilities extends Component {
  render() {

    if(this.props.data){
      var skills = this.props.data.resume.skills.map(function(skills){
        var skillLevel1 = (skills.level >= 1)?'glyphicon glyphicon-star filled':'glyphicon glyphicon-star';
        var skillLevel2 = (skills.level >= 2)?'glyphicon glyphicon-star filled':'glyphicon glyphicon-star';
        var skillLevel3 = (skills.level >= 3)?'glyphicon glyphicon-star filled':'glyphicon glyphicon-star';
        var skillLevel4 = (skills.level >= 4)?'glyphicon glyphicon-star filled':'glyphicon glyphicon-star';
        var skillLevel5 = (skills.level == 5)?'glyphicon glyphicon-star filled':'glyphicon glyphicon-star';

        return <li key={skills.name}>
          <span className="ability-title">{skills.name}</span>
					<span className="ability-score">
            <span className={skillLevel1}></span>
            <span className={skillLevel2}></span>
            <span className={skillLevel3}></span>
            <span className={skillLevel4}></span>
            <span className={skillLevel5}></span>
          </span>
        </li>
      })

      var halfSkills = Math.floor(skills.length / 2);

      var leftSkills = skills.slice(0, halfSkills);
      var rightSkills = skills.slice(halfSkills, skills.length);
    }

    return (
      <div className="background-white">
        <div id="abilities" className="container">				
          <h2>Skills</h2>
          <p className="lead"></p><hr/>
          <div className="row">			
            <div className="col-md-6">
              <ul className="no-bullets">{leftSkills}</ul>
            </div>
            <div className="col-md-6">
              <ul className="no-bullets">{rightSkills}</ul>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default Abilities;
