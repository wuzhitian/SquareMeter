import React, { Component } from 'react';
import { BrowserRouter as Router, Route } from 'react-router-dom';
import { MainPage } from './page/MainPage/MainPage';
import './data/initialData';

class App extends Component {
    render() {
        return (
            <Router>
                <Route component={ MainPage }/>
            </Router>
        )
    }
}

export default App