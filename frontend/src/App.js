import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import './App.css';
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
                <Routes>
                    <Route exact path="/" element={<Home />} />
                    <Route path="/books/:id" element={<BookDetails />} />
                    <Route path="/authors/:id" element={<AuthorDetails />} />
                    <Route path="/login" element={<Login />} />
                    <Route path="/add-book" element={<BookForm />} />
                    <Route path="/edit-book/:id" element={<BookForm />} />
                    <Route path="/add-author" element={<AuthorForm />} />
                    <Route path="/edit-author/:id" element={<AuthorForm />} />
                </Routes>
            </div>
        </Router>
    );
};

export default App;
