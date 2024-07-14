import React, { useEffect, useState } from 'react';
import { Link, useNavigate, useParams } from 'react-router-dom';
import api from '../services/api';

const BookForm = () => {
    const { id } = useParams();
    const [title, setTitle] = useState('');
    const [authorId, setAuthorId] = useState('');
    const [description, setDescription] = useState('');
    const [authors, setAuthors] = useState([]);
    const navigate = useNavigate();

    useEffect(() => {
        api.get('/authors').then(response => {
            setAuthors(response.data);
        });

        if (id) {
            api.get(`/books/${id}`).then(response => {
                const book = response.data;
                setTitle(book.title);
                setAuthorId(book.author_id);
                setDescription(book.description);
            });
        }
    }, [id]);

    const handleSubmit = async (e) => {
        e.preventDefault();
        const bookData = { title, author_id: authorId, description };

        try {
            if (id) {
                await api.put(`/books/${id}`, bookData);
            } else {
                await api.post('/books', bookData);
            }
            navigate('/')
        } catch (error) {
            console.error('There was an error saving the book!', error);
        }
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

            <h1>{id ? 'Edit Book' : 'Add Book'}</h1>
            <form onSubmit={handleSubmit}>
                <div>
                    <label>Title:</label>
                    <input
                        type="text"
                        value={title}
                        onChange={(e) => setTitle(e.target.value)}
                    />
                </div>
                <div>
                    <label>Author:</label>
                    <select
                        value={authorId}
                        onChange={(e) => setAuthorId(e.target.value)}
                    >
                        <option value="">Select Author</option>
                        {authors.map(author => (
                            <option key={author.id} value={author.id}>
                                {author.name}
                            </option>
                        ))}
                    </select>
                </div>
                <div>
                    <label>Description:</label>
                    <textarea
                        value={description}
                        onChange={(e) => setDescription(e.target.value)}
                    />
                </div>
                <button type="submit">{id ? 'Update' : 'Add'}</button>
            </form>
        </div>
    );
};

export default BookForm;
