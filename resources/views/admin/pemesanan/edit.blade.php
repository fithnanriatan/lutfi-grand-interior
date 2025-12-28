@extends('admin.layouts.app')

@section('title', 'Edit Pemesanan')
@section('page-title', 'Edit Pemesanan')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Form Edit Pemesanan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pemesanan.update', $pemesanan->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Data Pelanggan -->
                    <div class="col-md-6">
                        <h6 class="mb-3 text-primary">Data Pelanggan</h6>
                        
                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('nama_pelanggan') is-invalid @enderror" 
                                   id="nama_pelanggan" 
                                   name="nama_pelanggan" 
                                   value="{{ old('nama_pelanggan', $pemesanan->nama_pelanggan) }}"
                                   required>
                            @error('nama_pelanggan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telepon_pelanggan" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('telepon_pelanggan') is-invalid @enderror" 
                                   id="telepon_pelanggan" 
                                   name="telepon_pelanggan" 
                                   value="{{ old('telepon_pelanggan', $pemesanan->telepon_pelanggan) }}"
                                   placeholder="08xxxxxxxxxx"
                                   required>
                            @error('telepon_pelanggan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jalan" class="form-label">Alamat Jalan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('jalan') is-invalid @enderror" 
                                      id="jalan" 
                                      name="jalan" 
                                      rows="2"
                                      required>{{ old('jalan', $pemesanan->jalan) }}</textarea>
                            @error('jalan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kelurahan" class="form-label">Kelurahan/Desa <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('kelurahan') is-invalid @enderror" 
                                   id="kelurahan" 
                                   name="kelurahan" 
                                   value="{{ old('kelurahan', $pemesanan->kelurahan) }}"
                                   required>
                            @error('kelurahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('kecamatan') is-invalid @enderror" 
                                   id="kecamatan" 
                                   name="kecamatan" 
                                   value="{{ old('kecamatan', $pemesanan->kecamatan) }}"
                                   required>
                            @error('kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kota" class="form-label">Kota/Kabupaten <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('kota') is-invalid @enderror" 
                                   id="kota" 
                                   name="kota" 
                                   value="{{ old('kota', $pemesanan->kota) }}"
                                   required>
                            @error('kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Data Pemesanan -->
                    <div class="col-md-6">
                        <h6 class="mb-3 text-primary">Data Pemesanan</h6>
                        
                        <div class="mb-3">
                            <label for="layanan_id" class="form-label">Layanan <span class="text-danger">*</span></label>
                            <select class="form-select @error('layanan_id') is-invalid @enderror" 
                                    id="layanan_id" 
                                    name="layanan_id"
                                    required>
                                <option value="">Pilih Layanan</option>
                                @foreach($layanans as $layanan)
                                    <option value="{{ $layanan->id }}" 
                                        {{ old('layanan_id', $pemesanan->layanan_id) == $layanan->id ? 'selected' : '' }}>
                                        {{ $layanan->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('layanan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" 
                                   class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                   id="tanggal_mulai" 
                                   name="tanggal_mulai" 
                                   value="{{ old('tanggal_mulai', $pemesanan->tanggal_mulai?->format('Y-m-d')) }}"
                                   required>
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                            <input type="date" 
                                   class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                   id="tanggal_selesai" 
                                   name="tanggal_selesai" 
                                   value="{{ old('tanggal_selesai', $pemesanan->tanggal_selesai?->format('Y-m-d')) }}">
                            @error('tanggal_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga_final" class="form-label">Harga Final <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" 
                                       class="form-control @error('harga_final') is-invalid @enderror" 
                                       id="harga_final" 
                                       name="harga_final" 
                                       value="{{ old('harga_final', $pemesanan->harga_final) }}"
                                       min="0"
                                       step="1000"
                                       required>
                                @error('harga_final')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status"
                                    required>
                                <option value="pending" {{ old('status', $pemesanan->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ old('status', $pemesanan->status) == 'proses' ? 'selected' : '' }}>Dalam Proses</option>
                                <option value="selesai" {{ old('status', $pemesanan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ old('status', $pemesanan->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($pemesanan->status == 'selesai' && $pemesanan->review_token)
                                <small class="text-success">
                                    <i class="bi bi-check-circle"></i> Link review sudah dibuat
                                </small>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                      id="catatan" 
                                      name="catatan" 
                                      rows="4"
                                      placeholder="Catatan tambahan, kebutuhan khusus, dll...">{{ old('catatan', $pemesanan->catatan) }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection