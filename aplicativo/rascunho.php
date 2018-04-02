<div class="form-group">
                                            <label for="name"><i class="fa fa-chess-rook"></i> Selecione uma Torre | <a>Saiba mais.</a></label>
                                                <select class="form-control" name="torrePagina" id="torrePagina" required>
                                                    <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): //LISTA NOME DOS ALBUNS ?>
                                                    <?php $nomeTorre = $user['nomeTorre']; $idTorre = $user['idTorre'];?>
                                                        <option value="<?php echo $idTorre ?>"><?php echo $nomeTorre ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                        </div>