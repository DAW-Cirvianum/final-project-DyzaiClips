import { useState } from 'react'
import { useNavigate } from 'react-router-dom'
import api from '../api/axios'

function AdminCreateProduct() {
    const navigate = useNavigate()

    // Formulari producte
    const [name, setName] = useState('')
    const [type, setType] = useState('card')
    const [imageUrl, setImageUrl] = useState('') // ara és URL

    // New condition
    const [newPrice, setNewPrice] = useState('')
    const [newStock, setNewStock] = useState('')

    // Used condition
    const [usedPrice, setUsedPrice] = useState('')
    const [usedStock, setUsedStock] = useState('')

    // Feedback i errors
    const [message, setMessage] = useState('')
    const [error, setError] = useState({})
    const [loading, setLoading] = useState(false)

    const handleSubmit = async (e) => {
        e.preventDefault()
        setError({})
        setMessage('')
        setLoading(true)

        // VALIDACIÓ AL CLIENT
        const clientErrors = {}
        if (!name.trim()) clientErrors.name = 'Product name is required'
        if (!newPrice || Number(newPrice) <= 0) clientErrors.newPrice = 'Price must be positive'
        if (!newStock || Number(newStock) < 0) clientErrors.newStock = 'Stock must be 0 or more'
        if (!usedPrice || Number(usedPrice) <= 0) clientErrors.usedPrice = 'Price must be positive'
        if (!usedStock || Number(usedStock) < 0) clientErrors.usedStock = 'Stock must be 0 or more'
        if (imageUrl && !/^https?:\/\/.+\.(jpg|jpeg|png|gif)$/i.test(imageUrl)) {
            clientErrors.image = 'Invalid image URL'
        }

        if (Object.keys(clientErrors).length) {
            setError(clientErrors)
            setLoading(false)
            return
        }

        try {
            // Crear producte enviant URL
            const productRes = await api.post('/products', {
                name,
                type,
                image_url: imageUrl || null
            })
            const productId = productRes.data.id

            // NEW product value
            await api.post('/product-values', {
                product_id: productId,
                condition: 'new',
                price: newPrice,
                stock: newStock,
            })

            // USED product value
            await api.post('/product-values', {
                product_id: productId,
                condition: 'used',
                price: usedPrice,
                stock: usedStock,
            })

            setMessage('Product created successfully')
            setTimeout(() => navigate('/products'), 1000)

        } catch (err) {
            console.error(err)
            if (err.response) {
                switch (err.response.status) {
                    case 422:
                        setError(err.response.data.errors || { general: 'Validation failed' })
                        break
                    case 500:
                        setError({ general: 'Server error' })
                        break
                    default:
                        setError({ general: 'Unexpected error' })
                }
            } else {
                setError({ general: 'Cannot connect to server' })
            }
        } finally {
            setLoading(false)
        }
    }

    return (
        <div className="page-container">
            <h2>Create new product (Admin)</h2>

            {message && <p className="success">{message}</p>}
            {error.general && <p className="error">{error.general}</p>}

            <form onSubmit={handleSubmit} className="auth-form">

                {/* Name */}
                <div>
                    <input
                        type="text"
                        placeholder="Product name"
                        value={name}
                        onChange={e => setName(e.target.value)}
                        required
                    />
                    {error.name && <p className="error">{error.name}</p>}
                </div>

                {/* Type */}
                <div>
                    <select value={type} onChange={e => setType(e.target.value)}>
                        <option value="card">Card</option>
                        <option value="pack">Pack</option>
                        <option value="box">Box</option>
                    </select>
                </div>

                {/* Image URL */}
                <div>
                    <input
                        type="url"
                        placeholder="Image URL (optional)"
                        value={imageUrl}
                        onChange={e => setImageUrl(e.target.value)}
                    />
                    <small>Optional: paste an image URL</small>
                    {error.image && <p className="error">{error.image}</p>}
                </div>

                {/* New condition */}
                <h4>New condition</h4>
                <div>
                    <input
                        type="number"
                        placeholder="Price (€)"
                        value={newPrice}
                        onChange={e => setNewPrice(e.target.value)}
                        required
                    />
                    {error.newPrice && <p className="error">{error.newPrice}</p>}
                </div>
                <div>
                    <input
                        type="number"
                        placeholder="Stock"
                        value={newStock}
                        onChange={e => setNewStock(e.target.value)}
                        required
                    />
                    {error.newStock && <p className="error">{error.newStock}</p>}
                </div>

                {/* Used condition */}
                <h4>Used condition</h4>
                <div>
                    <input
                        type="number"
                        placeholder="Price (€)"
                        value={usedPrice}
                        onChange={e => setUsedPrice(e.target.value)}
                        required
                    />
                    {error.usedPrice && <p className="error">{error.usedPrice}</p>}
                </div>
                <div>
                    <input
                        type="number"
                        placeholder="Stock"
                        value={usedStock}
                        onChange={e => setUsedStock(e.target.value)}
                        required
                    />
                    {error.usedStock && <p className="error">{error.usedStock}</p>}
                </div>

                <button type="submit" disabled={loading}>
                    {loading ? 'Creating...' : 'Create product'}
                </button>
            </form>
        </div>
    )
}

export default AdminCreateProduct