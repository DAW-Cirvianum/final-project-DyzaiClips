import { useEffect, useState } from 'react'
import { useNavigate } from 'react-router-dom'
import api from '../api/axios'

function Products() {
    const [products, setProducts] = useState([])
    const [search, setSearch] = useState('')
    const isAdmin = localStorage.getItem('role') === 'admin'
    const navigate = useNavigate()

    const DEFAULT_IMAGE = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmqmO50dgbnr_H_uRf-NEz6YOrgZihbe7leg&s'

    useEffect(() => {
        api.get('/products')
            .then(res => setProducts(res.data))
            .catch(err => console.error(err))
    }, [])

    const handleDelete = async (id) => {
        if (!window.confirm('Are you sure you want to delete this product?')) return
        await api.delete(`/products/${id}`)
        setProducts(products.filter(p => p.id !== id))
    }

    const filteredProducts = products.filter(product =>
        product.name.toLowerCase().includes(search.toLowerCase())
    )

    return (
        <div className="page-container">
            <h2>Products</h2>

            {isAdmin && (
                <button
                    className="admin-btn"
                    onClick={() => navigate('/admin/products/create')}
                >
                    + Add new product
                </button>
            )}

            <input
                type="text"
                className="search-input"
                placeholder="Search product by name..."
                value={search}
                onChange={e => setSearch(e.target.value)}
            />

            <div className="product-grid">
                {filteredProducts.map(product => (
                    <div key={product.id} className="product-card">
                        <img
                            src={product.image_url || DEFAULT_IMAGE}
                            alt={product.name}
                            className="product-image"
                        />

                        <h3>{product.name}</h3>
                        <span className="product-type">{product.type}</span>

                        <button
                            className="product-btn"
                            onClick={() => navigate(`/products/${product.id}/prices`)}
                        >
                            View prices
                        </button>

                        {isAdmin && (
                            <div className="admin-actions">
                                <button
                                    className="product-btn edit"
                                    onClick={() => navigate(`/products/${product.id}/edit`)}
                                >
                                    Edit
                                </button>
                                <button
                                    className="product-btn delete"
                                    onClick={() => handleDelete(product.id)}
                                >
                                    Delete
                                </button>
                            </div>
                        )}
                    </div>
                ))}
            </div>
        </div>
    )
}

export default Products