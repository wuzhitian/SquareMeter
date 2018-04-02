import React, { Component } from 'react';
import { BrowserRouter as Router } from 'react-router-dom';

import { MainPage } from './pages/MainPage/MainPage';

class App extends Component {
    render() {
        return (
            <Router>
                <MainPage/>
            </Router>
        )
    }
}

export default App