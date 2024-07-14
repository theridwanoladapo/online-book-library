import React, { useEffect, useState } from 'react';
import { Link, useParams } from 'react-router-dom';
import api from '../services/api';

const BookDetails = () => {
    const { id } = useParams();
    const [book, setBook] = useState(null);

    useEffect(() => {
        api.get(`/books/${id}`)
            .then(response => {
                setBook(response.data);
            })
            .catch(error => {
                console.error('There was an error fetching the book details!', error);
            });
    }, [id]);

    if (!book) return <div>Loading...</div>;

    return (
        <div>
            <div className='menu'>
                <ul>
                    <li><Link className='link' to="/">Home</Link></li>
                    <li><Link className='link' to="/add-book">Add Book</Link></li>
                    <li><Link className='link' to="/add-author">Add Author</Link></li>
                </ul>
            </div>

            <h1>{book.title}</h1>
            <p>{book.description}</p>
            <p>Author: {book.author.name}</p>
        </div>
    );
};

export default BookDetails;
