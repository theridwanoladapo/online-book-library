import React from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import Home from './components/Home';
import BookDetails from './components/BookDetails';
import AuthorDetails from './components/AuthorDetails';
import Login from './components/Login';
import BookForm from './components/BookForm';
import AuthorForm from './components/AuthorForm';

const App = () => {
    return (
        <Router>
            <div className="App">
                <Switch>
                    <Route exact path="/" component={Home} />
                    <Route path="/books/:id" component={BookDetails} />
                    <Route path="/authors/:id" component={AuthorDetails} />
                    <Route path="/login" component={Login} />
                    <Route path="/add-book" component={BookForm} />
                    <Route path="/edit-book/:id" component={BookForm} />
                    <Route path="/add-author" component={AuthorForm} />
                    <Route path="/edit-author/:id" component={AuthorForm} />
                </Switch>
            </div>
        </Router>
    );
};

export default App;
