import React, { useEffect, useState } from 'react';
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
            <h1>Books</h1>
            <input
                type="text"
                placeholder="Search for books or authors..."
                value={query}
                onChange={handleSearch}
            />
            <ul>
                {books.map(book => (
                    <li key={book.id}>{book.title} by {book.author.name}</li>
                ))}
            </ul>
        </div>
    );
};

export default Home;
