import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import api from '../services/api';

const AuthorDetails = () => {
    const { id } = useParams();
    const [author, setAuthor] = useState(null);

    useEffect(() => {
        api.get(`/authors/${id}`)
            .then(response => {
                setAuthor(response.data);
            })
            .catch(error => {
                console.error('There was an error fetching the author details!', error);
            });
    }, [id]);

    if (!author) return <div>Loading...</div>;

    return (
        <div>
            <h1>{author.name}</h1>
            <p>{author.email}</p>
            <p>{author.biography}</p>
            <h2>Books by {author.name}</h2>
            <ul>
                {author.books.map(book => (
                    <li key={book.id}>{book.title}</li>
                ))}
            </ul>
        </div>
    );
};

export default AuthorDetails;
