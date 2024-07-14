import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import api from '../services/api';

const Home = () => {
    const [books, setBooks] = useState([]);
    const [query, setQuery] = useState('');

    useEffect(() => {
        if(query) {
            api.get(`/books/search?query=${query}`)
                .then(response => {
                    setBooks(response.data);
                })
                .catch(error => {
                    console.error('There was an error fetching the books!', error);
                });
        } else {
            api.get('/books')
                .then(response => {
                    setBooks(response.data);
                })
                .catch(error => {
                    console.error('There was an error fetching the books!', error);
                });
        }
    }, [query]);

    const handleSearch = (e) => {
        setQuery(e.target.value);
    };

    return (
        <div>
            <div className='menu'>
                <ul>
                    <li><Link className='link' to="/">Home</Link></li>
                    <li><Link className='link' to="/add-book">Add Book</Link></li>
                    <li><Link className='link' to="/add-author">Add Author</Link></li>
                </ul>
            </div>

            <h1 style={{"margin":"20px"}}>Books</h1>
            <form>
                <input
                    type="text"
                    placeholder="Search for books or authors..."
                    value={query}
                    onChange={handleSearch}
                />
            </form>
            <div className='book-section' style={{"maxWidth":"600px","margin":"20px","padding":"10px 20px"}}>
                <ul>
                    {books.map(book => (
                        <li key={book.id}>
                            <div className='book'>
                                <Link to={`/books/${book.id}`} className='book-title'>{book.title}</Link>
                                <div className='book-description'>{book.description}</div>
                                <Link to={`/authors/${book.author.id}`} className='book-author'>by: {book.author.name}</Link>
                            </div>
                        </li>
                    ))}
                </ul>
            </div>
        </div>
    );
};

export default Home;
