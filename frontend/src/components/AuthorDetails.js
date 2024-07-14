import React, { useEffect, useState } from 'react';
import { Link, useParams } from 'react-router-dom';
import api from '../services/api';

const AuthorDetails = () => {
    const { id } = useParams();
    const [author, setAuthor] = useState(null);
    const [books, setBooks] = useState([]);

    useEffect(() => {
        api.get(`/authors/${id}`)
            .then(response => {
                setAuthor(response.data);
            })
            .catch(error => {
                console.error('There was an error fetching the author details!', error);
            });

        api.get(`/books`).then(response => {
            setBooks(response.data);
        });
    }, [id]);

    if (!author) return <div>Loading...</div>;

    return (
        <div>
            <div className='menu'>
                <ul>
                    <li><Link className='link' to="/">Home</Link></li>
                    <li><Link className='link' to="/add-book">Add Book</Link></li>
                    <li><Link className='link' to="/add-author">Add Author</Link></li>
                </ul>
            </div>

            <h1>{author.name}</h1>
            <p><span style={{"fontWeight": "600"}}>Email: </span>{author.email}</p>
            <p><span style={{"fontWeight": "600"}}>Bio: </span>{author.biography}</p>
            <h3>Books by {author.name}</h3>
            <ul>
                {books
                    .filter(book => book.author.id === author.id)
                    .map((book, index) => (
                    <li key={book.id}>{book.title}</li>
                ))}
                {/* {books.map(book => (
                    <li key={book.id}>{book.title}</li>
                ))} */}
            </ul>
        </div>
    );
};

export default AuthorDetails;
